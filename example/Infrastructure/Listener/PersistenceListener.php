<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Infrastructure\Listener;

use Era269\MessageProcessor\MessageProcessorInterface;
use Era269\MethodMap\InterfaceMethodMap;
use Era269\Microobject\Message\Event\EventStorageInterface;
use Era269\Microobject\Message\EventInterface;
use Era269\Microobject\Traits\CanProcessMessageTrait;

final class PersistenceListener implements MessageProcessorInterface
{
    use CanProcessMessageTrait;

    public function __construct(
        private EventStorageInterface $eventStorage
    )
    {
        $this->setProcessMessageMethodMap(
            new InterfaceMethodMap(self::class)
        );
    }

    public function onEvent(EventInterface $event): void
    {
        $this->eventStorage->attachEvents($event->getDomainModelId(), $event);
    }
}
