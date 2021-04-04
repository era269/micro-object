<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Event;


use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\EventInterface;
use Iterator;

/**
 * @extends \Iterator<int,EventInterface>
 */
interface EventStreamInterface extends Iterator
{
    public function getDomainModelId(): IdentifierInterface;

    public function current(): EventInterface;

    public function next(): void;

    public function key(): int;

    public function valid(): bool;

    public function rewind(): void;

    public function attach(EventInterface $event): void;
}
