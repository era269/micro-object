<?php

declare(strict_types=1);

namespace Era269\TrueObject\Message;

use Era269\TrueObject\Message\Event\EventId;
use Era269\TrueObject\MessageInterface;
use Era269\TrueObject\NormalizableInterface;

interface EventInterface extends MessageInterface, NormalizableInterface
{
    public function getId(): EventId;
}
