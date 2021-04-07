<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message;

use Era269\Microobject\Message\Traits\MessageTrait;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\Normalizable\NullNormalizable;
use Era269\Normalizable\AbstractNormalizableObject;

abstract class AbstractMessage extends AbstractNormalizableObject implements MessageInterface
{
    use MessageTrait;

    public function __construct()
    {
        $this->setId(MessageId::generate());
        $this->setCreatedAt();
        $this->setPayload(new NullNormalizable());
    }
}
