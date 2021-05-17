<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message;

use Era269\Microobject\Message\Traits\MessageTrait;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\Normalizable\NullNormalizable;
use Era269\Normalizable\Traits\SimpleNormalizableTrait;

abstract class AbstractMessage implements MessageInterface
{
    use MessageTrait;
    use SimpleNormalizableTrait;

    public function __construct()
    {
        $this->setId(MessageId::generate());
        $this->setCreatedAt();
        $this->setPayload(new NullNormalizable());
    }
}
