<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\Microobject\Message\EventInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

trait CanPublishEventsTrait
{
    private EventDispatcherInterface $eventDispatcher;

    final protected function setEventDispatcher(EventDispatcherInterface $eventDispatcher): void
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    final protected function publish(EventInterface ...$events): void
    {
        foreach ($events as $event) {
            $this->publishThat($event);
        }
    }

    private function publishThat(object $event): void
    {
        $this->eventDispatcher->dispatch($event);
    }
}
