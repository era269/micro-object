<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Message\ResponseInterface;

interface MicroobjectCollectionInterface extends MessageProcessorInterface
{
    /**
     * @inheritDoc
     */
    public function process(MessageInterface $message): ResponseInterface;
}
