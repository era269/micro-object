<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Message\ResponseInterface;

interface MessageProcessorInterface extends \Era269\MessageProcessor\MessageProcessorInterface
{
    /**
     * @inheritDoc
     */
    public function process(\Era269\MessageProcessor\MessageInterface $message): ResponseInterface;
}
