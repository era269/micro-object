<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Event;

use DateTimeInterface;
use Era269\Microobject\Message\AbstractMessage;
use Era269\Microobject\Message\EventInterface;

abstract class AbstractEvent extends AbstractMessage implements EventInterface
{
    public function getOccurredAt(): DateTimeInterface
    {
        return $this->getCreatedAt();
    }
}
