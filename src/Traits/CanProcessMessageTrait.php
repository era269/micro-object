<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\MessageProcessor\MessageInterface;
use Era269\MessageProcessor\Traits\Aware\ProcessMessageMethodMapAwareTrait;
use Era269\Microobject\Message\NullMessage;

trait CanProcessMessageTrait
{
    use ProcessMessageMethodMapAwareTrait;

    public function process(MessageInterface $message): \Era269\Microobject\MessageInterface
    {
        $methodName = $this->getProcessMessageMethodMap()
            ->getMethodNames($message)[0];

        return $this->{$methodName}($message)
            ?? new NullMessage();
    }
}
