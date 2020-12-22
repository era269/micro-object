<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use ReflectionClass;
use ReflectionException;
use RuntimeException;

trait CanBuildMethodNameByFormat
{
    private function buildMethodName(string $methodNameFormat, object $parameter): string
    {
        try {
            $shortClassName = (new ReflectionClass($parameter))->getShortName();
        } catch (ReflectionException $e) {
            throw new RuntimeException('', 0, $e);
        }

        return sprintf($methodNameFormat, $shortClassName);
    }
}
