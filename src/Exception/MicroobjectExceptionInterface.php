<?php

declare(strict_types=1);

namespace Era269\Microobject\Exception;

use Era269\Normalizable\NormalizableInterface;
use Throwable;

interface MicroobjectExceptionInterface extends Throwable, NormalizableInterface
{

}
