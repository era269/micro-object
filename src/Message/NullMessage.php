<?php

declare(strict_types=1);

namespace Era269\Microobject\Message;

use Era269\Microobject\Identifier\StringId;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\Traits\MessageTrait;

final class NullMessage implements MessageInterface
{
    use MessageTrait;

    public function __construct()
    {
        $this->setId(
            new StringId('')
        );
    }
}
