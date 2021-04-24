<?php

declare(strict_types=1);

namespace Era269\Microobject\Cache;

use Era269\Microobject\Traits\NormalizableExceptionTrait;
use Era269\Normalizable\NormalizableInterface;
use RuntimeException;

final class InvalidArgumentException extends RuntimeException implements \Psr\SimpleCache\InvalidArgumentException, NormalizableInterface
{
    use NormalizableExceptionTrait;
}
