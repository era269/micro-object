<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\Normalizable\Adapter\ThrowableToNormalizableAdapter;

trait NormalizableExceptionTrait
{
    public function normalize(): array
    {
        return (new ThrowableToNormalizableAdapter($this))
            ->normalize();
    }

    public function getType(): string
    {
        return $this::class;
    }
}
