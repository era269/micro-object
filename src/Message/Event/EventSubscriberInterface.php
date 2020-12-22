<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Event;

use Era269\Microobject\Message\EventInterface;

interface EventSubscriberInterface
{
    public function notifyMe(EventInterface ...$events): void;
}
