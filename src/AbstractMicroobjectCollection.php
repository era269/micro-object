<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Cache\Adapter\PHPArray\ArrayCachePool;
use Era269\MessageProcessor\MethodMap\ExcludeMethodMapDecorator;
use Era269\MessageProcessor\MethodMap\OneOrLessMethodMapDecorator;
use Era269\MessageProcessor\MethodMap\OneOrMoreMethodMapDecorator;
use Era269\MessageProcessor\Traits\Aware\CacheAwareTrait;
use Era269\MethodMap\ClassNameMethodMap;
use Era269\MethodMap\InterfaceMethodMap;
use Era269\MethodMap\MethodMapCacheDecorator;
use Era269\MethodMap\MethodMapCollectionDecorator;
use Era269\MethodMap\MethodMapInterface;
use Era269\Microobject\Traits\CanProcessMessageTrait;
use Psr\SimpleCache\CacheInterface;

abstract class AbstractMicroobjectCollection implements MicroobjectCollectionInterface
{
    use CacheAwareTrait;
    use CanProcessMessageTrait;

    protected function getProcessMessageMethodMap(): MethodMapInterface
    {
        if (!isset($this->processMessageMethodMap)) {
            $this->processMessageMethodMap =
                new MethodMapCacheDecorator(
                    new OneOrMoreMethodMapDecorator(
                        new OneOrLessMethodMapDecorator(
                            new ExcludeMethodMapDecorator(
                                new MethodMapCollectionDecorator(
                                    new ClassNameMethodMap(static::class),
                                    new InterfaceMethodMap(static::class)
                                ),
                                ['process']
                            )
                        )
                    ),
                    $this->getCache(),
                    static::class
                );
        }

        return $this->processMessageMethodMap;
    }

    protected function getCache(): CacheInterface
    {
        if (!isset($this->cache)) {
            $this->cache = new ArrayCachePool();
        }

        return $this->cache;
    }
}
