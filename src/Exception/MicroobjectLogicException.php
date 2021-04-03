<?php

declare(strict_types=1);

namespace Era269\Microobject\Exception;

use Era269\Normalizable\Adapter\ThrowableToNormalizableAdapter;
use LogicException;

class MicroobjectLogicException extends LogicException implements MicroobjectExceptionInterface
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
