<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Cache\Adapter\PHPArray\ArrayCachePool;
use Era269\MessageProcessor\MethodMap\ExcludeMethodMapDecorator;
use Era269\MessageProcessor\MethodMap\OneOrLessMethodMapDecorator;
use Era269\MessageProcessor\MethodMap\OneOrMoreMethodMapDecorator;
use Era269\MessageProcessor\Traits\Aware\CacheAwareTrait;
use Era269\MessageProcessor\Traits\CanApplyEventsTrait;
use Era269\MessageProcessor\Traits\CanPublishEventsTrait;
use Era269\MethodMap\ClassNameMethodMap;
use Era269\MethodMap\InterfaceMethodMap;
use Era269\MethodMap\MethodMapCacheDecorator;
use Era269\MethodMap\MethodMapCollectionDecorator;
use Era269\MethodMap\MethodMapInterface;
use Era269\Microobject\Traits\CanProcessMessageTrait;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\SimpleCache\CacheInterface;
use ReflectionMethod;

abstract class AbstractMicroobject implements MicroobjectInterface
{
    use CacheAwareTrait;
    use CanApplyEventsTrait;
    use CanPublishEventsTrait;
    use CanProcessMessageTrait;

    public function __construct(EventDispatcherInterface $eventDispatcher, ?MethodMapInterface $processMessageMethodMap = null, ?MethodMapInterface $applyEventMethodMap = null, ?CacheInterface $cache = null)
    {
        $this->setEventDispatcher($eventDispatcher);
        $this->setCache($cache ?? new ArrayCachePool());
        $this->setProcessMessageMethodMap(
            $processMessageMethodMap
            ?? new MethodMapCacheDecorator(
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
            )
        );
        $this->setApplyEventMethodMap(
            $applyEventMethodMap
            ?? new MethodMapCacheDecorator(
                new OneOrMoreMethodMapDecorator(
                    new OneOrLessMethodMapDecorator(
                        new ClassNameMethodMap(
                            static::class,
                            ReflectionMethod::IS_PROTECTED
                        )
                    )
                ),
                $this->getCache(),
                static::class
            )
        );
    }

    protected function applyAndPublish(object ...$events): void
    {
        foreach ($events as $event) {
            $this->applyThat($event);
            $this->publishThat($event);
        }
    }
}
