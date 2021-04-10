<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Message\ResponseInterface;
use Era269\Normalizable\NormalizableInterface;

interface MicroobjectInterface extends
    NormalizableInterface,
    MessageProcessorInterface,
    IdentifiableInterface
{
    /**
     * @inheritDoc
     */
    public function process(MessageInterface $message): ResponseInterface;
}
