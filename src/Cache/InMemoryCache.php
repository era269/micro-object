<?php

declare(strict_types=1);

namespace Era269\Microobject\Cache;

use Psr\SimpleCache\CacheInterface;
use Traversable;

final class InMemoryCache implements CacheInterface
{
    /**
     * @param array<string, mixed> $cache
     */
    public function __construct(
        private array $cache = []
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function get($key, $default = null): mixed
    {
        $this->throwExceptionIfKeyNotLegal($key);

        return $this->cache[$key] ?? $default;
    }

    /**
     * @param string $key
     */
    private function throwExceptionIfKeyNotLegal(mixed $key): void
    {
        if (is_string($key) && preg_match("/^[a-zA-Z0-9_.]+$/", $key)) {
            return;
        }
        throw new InvalidArgumentException(sprintf(
            'Invalid key "%s". Please check documentation "%s"',
            $key,
            'https://www.php-fig.org/psr/psr-16/'
        ));
    }

    /**
     * @inheritDoc
     */
    public function set($key, $value, $ttl = null): bool
    {
        $this->throwExceptionIfKeyNotLegal($key);

        $this->cache[$key] = $value;

        return true;
    }

    /**
     * @inheritDoc
     */
    public function delete($key): bool
    {
        $this->throwExceptionIfKeyNotLegal($key);
        if (!isset($this->cache[$key])) {
            return false;
        }
        unset($this->cache[$key]);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function clear(): bool
    {
        $this->cache = [];

        return true;
    }

    /**
     * @inheritDoc
     * @param string[] $keys
     * @return array<string, mixed>
     */
    public function getMultiple($keys, $default = null): iterable
    {
        $this->throwExceptionIfParameterNotIterable($keys);
        $result = [];
        foreach ($keys as $key) {
            $this->throwExceptionIfKeyNotLegal($key);
            $result[$key] = $this->cache[$key] ?? $default;
        }
        return $result;
    }

    /**
     * @inheritDoc
     * @param iterable<string, mixed> $values
     */
    public function setMultiple($values, $ttl = null): bool
    {
        $this->throwExceptionIfParameterNotIterable($values);
        foreach ($values as $key => $value) {
            $this->throwExceptionIfKeyNotLegal($key);
            $this->cache[$key] = $value;
        }
        return true;
    }

    /**
     * @inheritDoc
     * @param string[] $keys
     */
    public function deleteMultiple($keys): bool
    {
        $this->throwExceptionIfParameterNotIterable($keys);
        foreach ($keys as $key) {
            $this->throwExceptionIfKeyNotLegal($key);
            unset($this->cache[$key]);
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function has($key): bool
    {
        $this->throwExceptionIfKeyNotLegal($key);
        return isset($this->cache[$key]);
    }

    private function throwExceptionIfParameterNotIterable(mixed $parameter): void
    {
        if (!is_array($parameter) && !$parameter instanceof Traversable) {
            throw new InvalidArgumentException('Parameter MUST be an array or a Traversable');
        }
    }
}
