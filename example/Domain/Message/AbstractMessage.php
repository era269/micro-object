<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message;

use Era269\Microobject\MessageInterface;
use Era269\Microobject\Traits\MessageTrait;

abstract class AbstractMessage implements MessageInterface
{
    use MessageTrait;

    public function __construct()
    {
        $this->setId(MessageId::generate());
    }
}
