<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Tests;


use Era269\Microobject\Message\EventInterface;
use Era269\Microobject\MessageProcessorInterface;
use LogicException;
use Psr\EventDispatcher\EventDispatcherInterface;

final class TestEventDispatcher implements EventDispatcherInterface
{
    /**
     * @param MessageProcessorInterface[] $listeners
     * @param array<string, EventInterface> $dispatchedEvents
     */
    public function __construct(
        private array $listeners = [],
        private array $dispatchedEvents = []
    ) {
    }

    /**
     * @inheritDoc
     */
    public function dispatch(object $event): void
    {
        if (!$event instanceof EventInterface) {
            throw new LogicException(sprintf(
                'Only "%s" can be dispatched. "%s" given',
                EventInterface::class,
                $event::class
            ));
        }
        $this->dispatchedEvents[$event::class] = $event;
        foreach ($this->listeners as $listener) {
            $listener->process($event);
        }
    }

    /**
     * @return array<string, EventInterface>
     */
    public function getDispatchedEvents(): array
    {
        return $this->dispatchedEvents;
    }
}
