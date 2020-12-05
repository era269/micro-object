<?php

declare(strict_types=1);

namespace Era269\TrueObject\Message;

use Era269\TrueObject\Message\Command\CommandId;
use Era269\TrueObject\MessageInterface;

interface CommandInterface extends MessageInterface
{
    public function getId(): CommandId;
}
