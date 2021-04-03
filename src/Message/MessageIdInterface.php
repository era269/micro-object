<?php

declare(strict_types=1);

namespace Era269\Microobject\Message;

use Era269\Microobject\IdentifierInterface;

interface MessageIdInterface extends IdentifierInterface
{
    public static function generate(): static;
}
