<?php
declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Exception\MicroobjectExceptionInterface;
use Era269\Microobject\Exception\MicroobjectRuntimeException;

interface MessageProcessorInterface
{
    /**
     * @throws MicroobjectExceptionInterface
     * @throws MicroobjectRuntimeException
     */
    public function process(MessageInterface $message): MessageInterface;
}
