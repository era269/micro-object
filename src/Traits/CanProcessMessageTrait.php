<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\MessageProcessor\MessageInterface;
use Era269\MessageProcessor\Traits\Aware\ProcessMessageMethodMapAwareTrait;
use Era269\Microobject\Example\Domain\Message\Response\NullResponse;
use Era269\Microobject\Message\ResponseInterface;

trait CanProcessMessageTrait
{
    use ProcessMessageMethodMapAwareTrait;

    public function process(MessageInterface $message): ResponseInterface
    {
        $methodName = $this->getProcessMessageMethodMap()
            ->getMethodNames($message)[0];

        return $this->{$methodName}($message)
            ?? new NullResponse();
    }
}
