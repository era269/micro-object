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
            if ($this->isMessageProcessingMethod($method)) {
                $this->attachToDocumentation(
                    $method->getName(),
                    $this->getFirstParameterClassName($method)
                );
            }
        }
    }

    private function isMessageProcessingMethod(ReflectionMethod $method): bool
    {
        return
            $this->isMethodHasOnlyParameterSubclassOf($method, MessageInterface::class) &&
            $method->getName() !== 'process';
    }

    private function isMethodHasOnlyParameterSubclassOf(ReflectionMethod $method, string $className): bool
    {
        return !empty($method->getParameters()) &&
            $method->getNumberOfParameters() === 1 &&
            is_subclass_of($this->getFirstParameterClassName($method), $className);
    }

    /**
     * @return class-string
     */
    private function getFirstParameterClassName(ReflectionMethod $method): string
    {
        $className = count($method->getParameters())
            ? (string)$method->getParameters()[0]->getType()
            : throw new MicroobjectLogicException(sprintf(
                'Method "%s::%s" should have at least one parameter',
                $method->getDeclaringClass(),
                $method->getName()
            ));
        return class_exists($className) || interface_exists($className)
            ? $className
            : throw new MicroobjectLogicException(sprintf(
                'Parameter has to be an instance of "%s". "%s" given',
                MessageInterface::class,
                $className
            ));
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
