<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Message\MessageIdInterface;

interface MessageInterface extends CreatedAtAwareInterface, NormalizableInterface
{
    public function getId(): MessageIdInterface;

    public function getTargetObjectId(): ?IdentifierInterface;

    public function getSourceObjectId(): IdentifierInterface;

    public function getReplyOnMessageId(): ?IdentifierInterface;
}
