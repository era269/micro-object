<?php
declare(strict_types=1);


namespace Era269\Microobject;


use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\ReplyInterface;

interface MessageProcessorInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function process(MessageInterface $message): ReplyInterface;
}
