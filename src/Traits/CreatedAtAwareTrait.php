<?php

declare(strict_types=1);

namespace Era269\TrueObject\Traits;

use DateTimeImmutable;
use DateTimeInterface;

trait CreatedAtAwareTrait
{
    private DateTimeInterface $createdAt;

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(): void
    {
        $this->createdAt = new DateTimeImmutable();
    }
}
