<?php
declare(strict_types=1);


namespace Era269\Microobject\Message;


use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\NormalizableInterface;

interface ReplyInterface extends MessageInterface
{
    public function getId(): MessageIdInterface;

    public function getTargetObjectId(): IdentifierInterface;

    public function getReplyOnMessageId(): IdentifierInterface;

    public function getPayload(): NormalizableInterface;
}
