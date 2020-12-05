<?php

declare(strict_types=1);

namespace Era269\TrueObject\Message\Command;

use Era269\TrueObject\Message\AbstractMessage;
use Era269\TrueObject\Message\CommandInterface;

final class AbstractCommand extends AbstractMessage implements CommandInterface
{
    private CommandId $id;

    public function __construct()
    {
        $this->id = new CommandId();
        $this->setCreatedAt();
    }

    public function getId()
    : CommandId
    {
        return $this->id;
    }
}
