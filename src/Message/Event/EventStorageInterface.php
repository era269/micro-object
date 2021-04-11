<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Event;

use Era269\Microobject\Exception\MicroobjectOutOfBoundsException;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\EventInterface;

interface EventStorageInterface
{
    public function attachEvents(IdentifierInterface $id, EventInterface ...$events): void;

    /**
     * @throws MicroobjectOutOfBoundsException
     */
    public function getEvents(IdentifierInterface $id): EventStreamInterface;
}
