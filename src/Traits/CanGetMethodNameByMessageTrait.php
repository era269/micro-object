<?php
declare(strict_types=1);


namespace Era269\Microobject\Traits;


use DomainException;
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
            ?? throw new DomainException(sprintf(
                'Incorrect internal method call: current object doesn\'t know how to process the message "%s"',
                $message::class
            ));
    }

    private function buildCache(): void
    {
        $selfReflection = new ReflectionObject($this);
        foreach ($selfReflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($this->isMessageProcessingMethod($method)) {
                $this->attachToDocumentation($method);
            }
        }
    }

    private function isMessageProcessingMethod(ReflectionMethod $method): bool
    {
        return
            $this->isMethodHasParameterSubclassOf($method, MessageInterface::class) &&
            $method->getName() !== 'process';
    }

    private function isMethodHasParameterSubclassOf(ReflectionMethod $method, string $className): bool
    {
        return !empty($method->getParameters()) &&
            $method->getNumberOfParameters() === 1 &&
            is_subclass_of((string)$method->getParameters()[0]->getType(), $className);
    }

    private function attachToDocumentation(ReflectionMethod $method): void
    {
        $messageClassName = (string) $method->getParameters()[0]->getType();
        $parameterReflection = new ReflectionClass($messageClassName);
        $parameterReflection->isInterface()
            ? $this->proxyMessageInterfaces[$messageClassName] = $method->getName()
            : $this->ownMessages[$messageClassName] = $method->getName();
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
