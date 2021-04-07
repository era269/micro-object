<?php

declare(strict_types=1);

namespace Era269\Microobject\Exception;

use Era269\Microobject\Traits\NormalizableExceptionTrait;
use LogicException;

class MicroobjectLogicException extends LogicException implements MicroobjectExceptionInterface
{
    use NormalizableExceptionTrait;
}
