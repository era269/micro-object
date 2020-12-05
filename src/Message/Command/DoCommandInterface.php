<?php

declare(strict_types=1);

namespace Era269\TrueObject\Message\Command;

use Era269\TrueObject\Exception\ExceptionInterface;
use Era269\TrueObject\Message\CommandInterface;

interface DoCommandInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function do(CommandInterface $command): ResultInterface;
}
