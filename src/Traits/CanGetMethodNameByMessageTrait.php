<?php
declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\Microobject\Exception\MicroobjectLogicException;
use Era269\Microobject\MessageInterface;
use ReflectionClass;
use ReflectionMethod;
use ReflectionObject;

trait CanGetMethodNameByMessageTrait
{
    /**
     * @var array<string, string>
     */
    private array $ownMessages;
    /**
     * @var array<string, string>
     */
    private array $proxyMessageInterfaces;

    private function getMethodNameByProcessedMessage(MessageInterface $message): string
    {
        if (empty($this->ownMessages) && empty($this->proxyMessageInterfaces)) {
            $this->buildCache();
        }
        return $this->getOwnMessageProcessMethod($message)
            ?? $this->getMessageInterfaceProcessMethod($message)
            ?? throw new MicroobjectLogicException(sprintf(
                'Incorrect internal method call: current object doesn\'t know how to process the message "%s"',
                $message::class
            ));
    }

    private function buildCache(): void
    {
        $this->ownMessages = [];
        $this->proxyMessageInterfaces = [];

        $selfReflection = new ReflectionObject($this);
        foreach ($selfReflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            $messageTypeClassName = $this->getMessageTypeClassNameOrFalse($method);
            if ($messageTypeClassName) {
                $this->attachToDocumentation(
                    $method->getName(),
                    $messageTypeClassName
                );
            }
        }
    }

    /**
     * @return class-string|false
     */
    private function getMessageTypeClassNameOrFalse(ReflectionMethod $method): string|false
    {
        if ($method->getNumberOfParameters() !== 1) {
            return false;
        }

        $parameterType = (string)$method->getParameters()[0]->getType();

        if (!is_subclass_of($parameterType, MessageInterface::class)) {
            return false;
        }
        if ($method->getName() === 'process') {
            return false;
        }
        return $parameterType;
    }

    /**
     * @param class-string $messageClassName
     */
    private function attachToDocumentation(string $methodName, string $messageClassName): void
    {
        (new ReflectionClass($messageClassName))->isInterface()
            ? $this->proxyMessageInterfaces[$messageClassName] = $methodName
            : $this->ownMessages[$messageClassName] = $methodName;
    }

    private function getOwnMessageProcessMethod(MessageInterface $message): ?string
    {
        return $this->ownMessages[$message::class]
            ?? null;
    }

    private function getMessageInterfaceProcessMethod(MessageInterface $message): ?string
    {
        foreach ($this->proxyMessageInterfaces as $proxyMessageInterface => $methodName) {
            if ($message instanceof $proxyMessageInterface) {
                return $methodName;
            }
        }
        return null;
    }
}
