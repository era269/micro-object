<?php

declare(strict_types=1);

namespace Era269\Microobject\Message;

use DateTimeInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\MessageInterface;

interface EventInterface extends MessageInterface
{
    public function getDomainModelId(): IdentifierInterface;

    public function getOccurredAt(): DateTimeInterface;
}
