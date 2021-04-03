<?php

declare(strict_types=1);

namespace Era269\Microobject\Exception;

use Era269\Normalizable\Adapter\ThrowableToNormalizableAdapter;
use RuntimeException;

class MicroobjectRuntimeException extends RuntimeException implements MicroobjectExceptionInterface
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
