<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Message\MessageIdInterface;
use Era269\Normalizable\NormalizableInterface;

interface MessageInterface extends CreatedAtAwareInterface, NormalizableInterface, IdentifiableInterface
{
    public function getId(): MessageIdInterface;

    public function getPayload(): NormalizableInterface;
}
