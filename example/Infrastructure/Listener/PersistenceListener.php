<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Infrastructure\Listener;

use DomainException;
use Era269\Microobject\Message\Event\EventStorageInterface;
use Era269\Microobject\Message\EventInterface;
use Era269\Microobject\Message\Response\NullResponse;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\MessageProcessorInterface;
use Era269\Microobject\Traits\CanGetMethodNameByMessageTrait;

final class PersistenceListener implements MessageProcessorInterface
{
    use CanGetMethodNameByMessageTrait;

    public function __construct(
        private EventStorageInterface $eventStorage
    )
    {
    }

    public function onEvent(EventInterface $event): void
    {
        $this->eventStorage->attachEvents($event->getDomainModelId(), $event);
    }

    public function process(MessageInterface $message): MessageInterface
    {
        try {
            $methodName = $this->getMethodNameByProcessedMessage($message);
            $this->$methodName($message);
        } catch (DomainException) {
            // do nothing
        }

        return new NullResponse();
    }
}
