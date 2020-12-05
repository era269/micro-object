<?php

declare(strict_types=1);

namespace Era269\TrueObject\Message\Event;

use Era269\TrueObject\Message\AbstractMessage;
use Era269\TrueObject\Message\EventInterface;

abstract class AbstractEvent extends AbstractMessage implements EventInterface
{
    private EventId $id;

    public function __construct()
    {
        $this->id = new EventId();
        $this->setCreatedAt();
    }

    public function getId()
    : EventId
    {
        return $this->id;
    }
}
