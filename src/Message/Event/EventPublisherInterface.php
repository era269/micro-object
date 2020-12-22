<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Event;

use Era269\Microobject\Message\EventInterface;

interface EventPublisherInterface
{
    public function attachSubscriber(EventSubscriberInterface ...$subscribers): void;

    public function detachSubscriber(EventSubscriberInterface ...$subscribers): void;

    public function publish(EventInterface ...$events): void;
}
