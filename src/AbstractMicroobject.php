<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Message\EventInterface;
use Era269\Microobject\Message\Response\PositiveEmptyResponse;
use Era269\Microobject\Traits\CanApplyPrivateEventsTrait;
use Era269\Microobject\Traits\CanPublishEventsTrait;
use Era269\Microobject\Traits\CanGetMethodNameByMessageTrait;
use Era269\Normalizable\AbstractNormalizableObject;

abstract class AbstractMicroobject extends AbstractNormalizableObject implements MicroobjectInterface
{
    use CanGetMethodNameByMessageTrait;
    use CanApplyPrivateEventsTrait;
    use CanPublishEventsTrait;

    /**
     * @inheritDoc
     */
    final public function process(MessageInterface $message): MessageInterface
    {
        $methodName = $this->getMethodNameByProcessedMessage($message);

        return $this->$methodName($message)
            ?? new PositiveEmptyResponse();
    }

    protected function applyAndPublish(EventInterface $event): void
    {
        $this->apply($event);
        $this->publish($event);
    }
}
