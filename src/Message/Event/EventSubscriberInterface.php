<?php

declare(strict_types=1);

namespace Era269\TrueObject\Message\Event;

use Era269\TrueObject\Message\EventInterface;

interface EventSubscriberInterface
{
    public function notifyMe(EventInterface ...$events): void;
}
