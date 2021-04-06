<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\Microobject\Message\EventInterface;

trait MicroobjectTrait
{
    use CanProcessMessageTrait;
    use CanApplyPrivateEventsTrait;
    use CanPublishEventsTrait;

    protected function applyAndPublish(EventInterface $event): void
    {
        $this->apply($event);
        $this->publish($event);
    }
}
