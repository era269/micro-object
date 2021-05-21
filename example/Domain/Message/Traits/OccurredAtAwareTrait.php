<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Traits;

use DateTimeInterface;
use Era269\Normalizable\Object\DateTimeRfc3339Normalizable;

trait OccurredAtAwareTrait
{
    protected DateTimeInterface $occurredAt;

    public function getOccurredAt(): DateTimeInterface
    {
        return $this->occurredAt;
    }

    protected function setOccurredAt(): void
    {
        $this->occurredAt = new DateTimeRfc3339Normalizable();
    }
}
