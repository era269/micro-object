<?php
declare(strict_types=1);

namespace Era269\Microobject\Message;

interface MessageIdAwareInterface
{
    public function getMessageId(): MessageIdInterface;
}
