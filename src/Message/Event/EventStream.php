<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Event;

use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\EventInterface;

final class EventStream implements EventStreamInterface
{
    /**
     * @var EventInterface[]
     */
    private array $events;
    private int $position = 0;

    public function __construct(
        private IdentifierInterface $identifier,
        EventInterface ...$events
    )
    {
        $this->events = $events;
    }

    public function getDomainModelId(): IdentifierInterface
    {
        return $this->identifier;
    }

    public function current(): EventInterface
    {
        return $this->events[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->events[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function attach(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
