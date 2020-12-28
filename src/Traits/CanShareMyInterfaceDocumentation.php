<?php
declare(strict_types=1);


namespace Era269\Microobject\Traits;


use Era269\Microobject\MessageInterface;
use ReflectionClass;
use ReflectionMethod;
use ReflectionObject;

trait CanShareMyInterfaceDocumentation
{
    /**
     * @var string[]
     */
    private array $documentation;

    public function getInterfaceDocumentation(?string $interfaceClassName = null): array
    {
        if (empty($this->documentation)) {
            $selfReflection = $this->getReflection($interfaceClassName);
            foreach ($selfReflection->getMethods() as $method) {
                if ($this->isMessageProcessingMethod($method)) {
                    $this->attachToDocumentation($method);
                }
            }
        }

        return $this->documentation;
    }

    /**
     * @return ReflectionClass|ReflectionObject
     */
    private function getReflection(?string $interfaceClassName)
    {
        $selfReflection = new ReflectionObject($this);
        if ($interfaceClassName) {
            foreach ($selfReflection->getInterfaces() as $interface) {
                if ($interfaceClassName === $interface->getName()) {
                    $selfReflection = $interface;
                }
            }
        }
        return $selfReflection;
    }

    private function isMessageProcessingMethod(ReflectionMethod $method): bool
    {
        return $method->isPublic() &&
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
        $messageClassName = $method->getParameters()[0]->getType();
        $this->documentation[$messageClassName] = $method->getName();
    }

}
