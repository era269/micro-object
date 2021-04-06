<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\Microobject\Exception\MicroobjectRuntimeException;
use Era269\Microobject\Message\Response\PositiveEmptyResponse;
use Era269\Microobject\Message\ResponseInterface;
use Era269\Microobject\MessageInterface;

trait CanProcessMessageTrait
{
    use CanGetMethodNameByMessageTrait;

    /**
     * @throws MicroobjectRuntimeException
     */
    final public function process(MessageInterface $message): ResponseInterface
    {
        $methodName = $this->getMethodNameByProcessedMessage($message);

        return $this->$methodName($message)
            ?? new PositiveEmptyResponse();
    }
}
