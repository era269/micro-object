<?php

declare(strict_types=1);

namespace Era269\TrueObject\Message\Event;

use Era269\TrueObject\Message\EventInterface;

interface EventPublisherInterface
{
    public function attachSubscriber(EventSubscriberInterface ...$subscribers): void;

    public function detachSubscriber(EventSubscriberInterface ...$subscribers): void;

    public function publish(EventInterface ...$events): void;
}
