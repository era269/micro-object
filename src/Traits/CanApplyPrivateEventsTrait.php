<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\Microobject\Exception\MicroobjectLogicException;
use Era269\Microobject\Message\EventInterface;
use ReflectionMethod;
use ReflectionObject;

trait CanApplyPrivateEventsTrait
{
    /**
     * @var array<string, string>
     */
    private array $applyEventMap;

    final protected function apply(EventInterface $event): void
    {
        $methodName = $this->getApplyEventMap()[$event::class]
            ?? throw new MicroobjectLogicException(sprintf(
                'Cannot apply "%s". It is unknown for the "%s"',
                $event::class,
                static::class
            ));
        $this->$methodName($event);
    }

    /**
     * @return array<string, string>
     */
    private function getApplyEventMap(): array
    {
        if (!isset($this->applyEventMap)) {
            $this->applyEventMap = [];
            $selfReflection = new ReflectionObject($this);
            foreach ($selfReflection->getMethods(ReflectionMethod::IS_PROTECTED) as $method) {
                $this->tryAddToApplyEventMap($method);
            }
        }

        return $this->applyEventMap;
    }

    private function tryAddToApplyEventMap(ReflectionMethod $method): void
    {
        if ($method->getNumberOfParameters() !== 1) {
            return;
        }
        $parameterTypeName = (string) $method->getParameters()[0]->getType();
        if (!is_subclass_of($parameterTypeName, EventInterface::class)) {
            return;
        }
        $this->applyEventMap[$parameterTypeName] = $method->getName();
    }
}
