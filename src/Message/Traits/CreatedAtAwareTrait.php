<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Traits;

use DateTimeInterface;
use Era269\Normalizable\Normalizable\DateTimeRfc3339Normalizable;

trait CreatedAtAwareTrait
{
    private DateTimeRfc3339Normalizable $createdAt;

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    final protected function setCreatedAt(): void
    {
        $this->createdAt = new DateTimeRfc3339Normalizable();
    }
}
