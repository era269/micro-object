<?php
declare(strict_types=1);


namespace Era269\Microobject;


use DomainException;
use Era269\Microobject\Message\ReplyInterface;

interface MessageProcessorInterface
{
    /**
     * @throws DomainException
     */
    public function process(MessageInterface $message): ReplyInterface;
}
