<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;


use Era269\Microobject\Message\EventInterface;

trait ApplyEventTrait
{
    final protected function applyEvent(string $methodName, EventInterface $event)
    {
        $this->$methodName($event);
    }
}
