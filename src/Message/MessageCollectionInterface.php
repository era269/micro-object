<?php
declare(strict_types=1);


namespace Era269\Microobject\Message;


use Era269\Microobject\CollectionInterface;
use Era269\Microobject\Message\Exception\MessageExceptionInterface;
use Era269\Microobject\MessageInterface;

interface MessageCollectionInterface extends CollectionInterface
{
    /**
     * @throws MessageExceptionInterface
     */
    public function attach(MessageInterface $message): void;

    public function detach(MessageInterface $message): void;

    public function contains(MessageInterface $message): bool;
}
