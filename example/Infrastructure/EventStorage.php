<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Infrastructure;

use Era269\Microobject\Exception\MicroobjectOutOfBoundsException;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\Event\EventStorageInterface;
use Era269\Microobject\Message\Event\EventStream;
use Era269\Microobject\Message\Event\EventStreamInterface;
use Era269\Microobject\Message\EventInterface;

final class EventStorage implements EventStorageInterface
{
    /**
     * @param EventStreamInterface[] $storage
     */
    public function __construct(
        private array $storage = []
    )
    {
    }

    public function getEvents(IdentifierInterface $id): EventStreamInterface
    {
        $idString = (string) $id;
        return $this->storage[$idString]
            ?? throw new MicroobjectOutOfBoundsException($id, EventStreamInterface::class);
    }

    public function attachEvents(IdentifierInterface $id, EventInterface ...$events): void
    {
        $idString = (string) $id;
        if (isset($this->storage[$idString])) {
            foreach ($events as $event) {
                $this->storage[$idString]->attach($event);
            }
        } else {
            $this->storage[$idString] = new EventStream($id, ...$events);
        }
    }
}
