<?php
declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\Microobject\Exception\MicroobjectLogicException;
use Era269\Microobject\MessageInterface;
use ReflectionClass;
use ReflectionMethod;

trait CanGetMethodNameByMessageTrait
{
    /**
     * @var array<string, mixed>
     */
    private static array $methodNamesMap;
    private static string $interfacesMapKey = 'interfaces';

    private static function getMethodNameByProcessedMessage(MessageInterface $message): string
    {
        $processingMethodName = static::getMap(static::class)[$message::class] ?? null;
        if ($processingMethodName) {
            return $processingMethodName;
        }
        foreach (static::getInterfaceMap(static::class) as $interface => $methodName) {
            if ($message instanceof $interface) {
                return $methodName;
            }
        }

        throw new MicroobjectLogicException(sprintf(
            'Incorrect internal method call: "%s" doesn\'t know how to process the message "%s"',
            static::class,
            $message::class
        ));
    }

    /**
     * @param class-string $className
     *
     * @return array<string, mixed>
     */
    private static function getMap(string $className): array
    {
        if (isset(static::$methodNamesMap[$className])) {
            return static::$methodNamesMap[$className];
        }
        static::$methodNamesMap[$className] = [
            static::$interfacesMapKey => [],
        ];

        $selfReflection = new ReflectionClass($className);
        foreach ($selfReflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
            if ($method->getNumberOfParameters() !== 1) {
                continue;
            }
            $parameterType = (string) $method->getParameters()[0]->getType();
            if (!is_subclass_of($parameterType, MessageInterface::class)) {
                continue;
            }

            $methodName = $method->getName();
            if ((new ReflectionClass($parameterType))->isInterface()) {
                static::$methodNamesMap[$className][static::$interfacesMapKey][$parameterType] = $methodName;
            } else {
                static::$methodNamesMap[$className][$parameterType] = $methodName;
            }
        }

        return static::$methodNamesMap[$className];
    }

    /**
     * @param class-string $className
     *
     * @return array<string, string>
     */
    private static function getInterfaceMap(string $className): array
    {
        return static::getMap($className)[static::$interfacesMapKey];
    }
}
