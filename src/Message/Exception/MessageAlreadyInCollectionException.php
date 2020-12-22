<?php
declare(strict_types=1);

namespace Era269\Microobject\Message\Exception;

use Era269\Microobject\MessageInterface;
use Exception;

class MessageAlreadyInCollectionException extends Exception implements MessageExceptionInterface
{
    private MessageInterface $messageObject;

    public function __construct(MessageInterface $messageObject)
    {
        parent::__construct();
        $this->messageObject = $messageObject;
    }

    public function normalize(): array
    {
        // TODO: Implement normalized() method.
    }
}
