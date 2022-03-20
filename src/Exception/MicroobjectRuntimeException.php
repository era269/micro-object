<?php

declare(strict_types=1);

namespace Era269\Microobject\Exception;

use Era269\Microobject\Traits\NormalizableExceptionTrait;
use Era269\Normalizable\Traits\NormalizableTrait;
use RuntimeException;

class MicroobjectRuntimeException extends RuntimeException implements MicroobjectExceptionInterface
{
    use NormalizableTrait;
}
