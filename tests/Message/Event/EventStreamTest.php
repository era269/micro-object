<?php

declare(strict_types=1);

namespace Era269\Microobject\Tests\Message\Event;

use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\Event\EventStream;
use Era269\Microobject\Message\EventInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EventStreamTest extends TestCase
{
    private EventStream $eventStream;
    /**
     * @var EventInterface[]
     */
    private array $events;
    private MockObject|IdentifierInterface $domainModelId;
    /**
     * @var EventInterface[]
     */
    private array $initialEvents;

    public function test(): void
    {
        foreach ($this->events as $event) {
            $this->eventStream->attach($event);
        }
        $count = 0;
        foreach ($this->eventStream as $key => $item) {
            self::assertInstanceOf(EventInterface::class, $item);
            $count++;
        }
        self::assertEquals(count($this->events) + count($this->initialEvents), $count);
        self::assertSame($this->domainModelId, $this->eventStream->getDomainModelId());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $event = $this->createMock(EventInterface::class);
        $this->initialEvents = [$event];
        $this->domainModelId = $this->createMock(IdentifierInterface::class);
        $this->eventStream = new EventStream(
            $this->domainModelId,
            ...$this->initialEvents
        );
        $this->events = [
            clone $event,
            clone $event,
            clone $event,
        ];
    }
}
