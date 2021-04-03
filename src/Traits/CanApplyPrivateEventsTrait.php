<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;


use Era269\Microobject\Message\EventInterface;
use ReflectionMethod;
use ReflectionObject;

trait CanApplyPrivateEventsTrait
{
    /**
     * @var array<string, string>
     */
    private array $applyEventMap;

    /**
     * @return array<string, string>
     */
    private function getApplyEventMap(): array
    {
        if (empty($this->applyEventMap)) {
            $selfReflection = new ReflectionObject($this);
            foreach ($selfReflection->getMethods(ReflectionMethod::IS_PRIVATE) as $method) {
                if ($this->isEventProcessingMethod($method)) {
                    $eventClassName = (string) $method->getParameters()[0]->getType();
                    $this->applyEventMap[$eventClassName] = $method->getName();
                }
            }
        }

        return $this->applyEventMap;
    }

    final protected function apply(EventInterface $event): void
    {
        $methodName = $this->getApplyEventMap()[$event::class];
        $this->applyEvent($methodName, $event);
    }

    abstract protected function applyEvent(string $methodName, EventInterface $event): void;

    private function isEventProcessingMethod(ReflectionMethod $method): bool
    {
        return !empty($method->getParameters()) &&
            $method->getNumberOfParameters() === 1 &&
            is_subclass_of((string)$method->getParameters()[0]->getType(), EventInterface::class);
    }
}
