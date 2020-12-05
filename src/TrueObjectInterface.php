<?php

declare(strict_types=1);

namespace Era269\TrueObject;

use Era269\TrueObject\Message\Command\DoCommandInterface;
use Era269\TrueObject\Message\Event\EventPublisherInterface;
use Era269\TrueObject\Message\Event\EventSubscriberInterface;
use Era269\TrueObject\Message\Request\HandleRequestInterface;

interface TrueObjectInterface extends
    SubjectCollectionAwareInterface,
    EventSubscriberInterface,
    EventPublisherInterface,
    HandleRequestInterface,
    DoCommandInterface
{

}
