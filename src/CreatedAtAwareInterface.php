<?php

declare(strict_types=1);

namespace Era269\TrueObject;

use DateTimeInterface;

interface CreatedAtAwareInterface
{
    public function getCreatedAt(): DateTimeInterface;
}
