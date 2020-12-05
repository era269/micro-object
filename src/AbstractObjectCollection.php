<?php

declare(strict_types=1);

namespace Era269\TrueObject;

use Era269\TrueObject\Exception\InfrastructureExceptionInterface;
use Era269\TrueObject\Message\Command\ResultInterface;
use Era269\TrueObject\Message\CommandInterface;
use Era269\TrueObject\Message\Request\ResponseInterface;
use Era269\TrueObject\Message\RequestInterface;

abstract class AbstractObjectCollection extends AbstractObject
{
    private ?TrueObjectInterface $currentObject = null;

    public function do(CommandInterface $command)
    : ResultInterface
    {
        $this->updateSubscriptionAndSubjectsRegardingInputMessage($command);

        return parent::do($command);
    }

    public function handle(RequestInterface $request)
    : ResponseInterface
    {
        $this->updateSubscriptionAndSubjectsRegardingInputMessage($request);

        return parent::handle($request);
    }

    /**
     * @throws InfrastructureExceptionInterface
     */
    protected function updateSubscriptionAndSubjectsRegardingInputMessage(MessageInterface $message)
    : void
    {
        $this->clearObjectSpecificSubject();
        $this->subscribeOnAndAttachToSubjectQueueIfMessageObjectSpecific($message);
    }

    protected function clearObjectSpecificSubject()
    : void
    {
        if (!is_null($this->currentObject)) {
            $this->detachSubject($this->currentObject);
            $this->currentObject = null;
        }
    }

    /**
     * @throws InfrastructureExceptionInterface
     */
    abstract protected function getOffsetByMessage(MessageInterface $message)
    : ?TrueObjectInterface;

    /**
     * @throws InfrastructureExceptionInterface
     */
    private function subscribeOnAndAttachToSubjectQueueIfMessageObjectSpecific(MessageInterface $message)
    : void
    {
        $this->currentObject = $this->getOffsetByMessage($message);
        if (!is_null($this->currentObject)) {
            $this->subscribeOnAndAttachToSubjectQueue(
                $this->currentObject
            );
        }
    }
}
