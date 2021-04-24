<?php
declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\Microobject\Cache\InMemoryCache;
use Era269\Microobject\Exception\MicroobjectLogicException;
use Era269\Microobject\MessageInterface;
use Psr\SimpleCache\CacheInterface;
use ReflectionClass;
use ReflectionMethod;
use ReflectionObject;

trait CanGetMethodNameByMessageTrait
{
    private CacheInterface $cache;

    private bool $cacheInitialized = false;

    /**
     * @return array<string, string>
     */
    private function getInterfaceMap(): array
    {
        return $this->getCache()->get(
            $this->getInterfaceMapCacheKey()
        );
    }

    final protected function setCache(?CacheInterface $cache = null): void
    {
        $this->cache = $cache ?? new InMemoryCache();
    }

    private function getCache(): CacheInterface
    {
        if (empty($this->cache)) {
            $this->setCache();
        }
        return $this->cache;
    }

    private function attachToClassNameMap(string $messageClassName, string $methodName): void
    {
        $this->getCache()->set(
            $this->getClassNameCacheKey($messageClassName),
            $methodName
        );
    }

    private function getMethodNameByProcessedMessage(MessageInterface $message): string
    {
        return $this->tryGetFromCache($message)
            ?? $this->tryGetProcessMethod($message)
            ?? $this->tryGetProcessMethodByMessageInterface($message)
            ?? throw new MicroobjectLogicException(sprintf(
                'Incorrect internal method call: current object doesn\'t know how to process the message "%s"',
                $message::class
            ));
    }

    private function buildCache(): void
    {
        $selfReflection = new ReflectionObject($this);
        $interfaceMap = [];
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

                $interfaceMap[$parameterType] = $methodName;
            } else {

                $this->attachToClassNameMap($parameterType, $methodName);
            }
        }
        $this->getCache()->set(
            $this->getInterfaceMapCacheKey(),
            $interfaceMap
        );
    }

    private function tryGetProcessMethod(MessageInterface $message): ?string
    {
        if (!$this->cacheInitialized) {
            $this->buildCache();
            $this->cacheInitialized = true;
        }

        return $this->tryGetFromCache($message);
    }

    private function tryGetProcessMethodByMessageInterface(MessageInterface $message): ?string
    {
        foreach ($this->getInterfaceMap() as $interface => $methodName) {
            if ($message instanceof $interface) {
                $this->attachToClassNameMap($message::class, $methodName);
                return $methodName;
            }
        }

        return null;
    }

    private function getClassNameCacheKey(string $messageClassName): string
    {
        return $this->getCacheKey($messageClassName);
    }

    private function getCacheKey(string $salt = ''): string
    {
        return md5($this::class . $salt);
    }

    private function tryGetFromCache(MessageInterface $message): ?string
    {
        return $this->getCache()->get(
            $this->getClassNameCacheKey($message::class)
        );
    }

    private function getInterfaceMapCacheKey(): string
    {
        return $this->getCacheKey('interfaceMap');
    }
}
