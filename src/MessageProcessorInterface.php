<?php
declare(strict_types=1);


namespace Era269\Microobject;


use RuntimeException;

interface MessageProcessorInterface
{
    /**
     * @throws RuntimeException
     */
    public function process(MessageInterface $message): MessageInterface;
}
