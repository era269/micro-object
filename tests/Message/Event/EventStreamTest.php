<?php

declare(strict_types=1);

namespace Era269\Microobject\Tests\Message\Event;

use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\Event\EventStream;
use Era269\Microobject\Message\EventInterface;
use PHPUnit\Framework\TestCase;

class EventStreamTest extends TestCase
{
    private EventStream $eventStream;
    /**
     * @var EventInterface[]
     */
    private array $events;

    public function test()
    {
        foreach ($this->events as $event) {
            $this->eventStream->attach($event);
        }
        $count = 0;
        foreach ($this->eventStream as $item) {
            self::assertInstanceOf(EventInterface::class, $item);
            $count++;
        }
        self::assertEquals(count($this->events) + 1, $count);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $event = $this->createMock(EventInterface::class);
        $this->eventStream = new EventStream(
            $this->createMock(IdentifierInterface::class),
            $event
        );
        $this->events = [
            clone $event,
            clone $event,
            clone $event,
        ];
    }
}
