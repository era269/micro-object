<?php

declare(strict_types=1);

namespace Era269\TrueObject;

use Era269\TrueObject\Message\MessageIdInterface;

interface MessageInterface extends CreatedAtAwareInterface
{
    public function getId(): MessageIdInterface;
}
