<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Event;


use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\EventInterface;
use OutOfBoundsException;

interface EventStorageInterface
{
    public function attachEvents(IdentifierInterface $id, EventInterface ...$events): void;
    /**
     * @throws OutOfBoundsException
     */
    public function getEvents(IdentifierInterface $id): EventStreamInterface;
}
