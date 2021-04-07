<?php

declare(strict_types=1);

namespace Era269\Microobject\Identifier;

use Era269\Microobject\Message\MessageIdInterface;

final class NullMessageIdentifier extends BaseIdentifier implements MessageIdInterface
{
    public static function generate(): static
    {
        return new self('');
    }
}
