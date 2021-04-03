<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Psr\EventDispatcher\EventDispatcherInterface;

trait CanPublishEventsTrait
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher
    )
    {
    }

    private function publish(object $event): void
    {
        $this->eventDispatcher->dispatch($event);
    }
}
