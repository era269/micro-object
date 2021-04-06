<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Psr\EventDispatcher\EventDispatcherInterface;

trait CanPublishEventsTrait
{
    private EventDispatcherInterface $eventDispatcher;

    final protected function setEventDispatcher(EventDispatcherInterface $eventDispatcher): void
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    final protected function publish(object $event): void
    {
        $this->eventDispatcher->dispatch($event);
    }
}
