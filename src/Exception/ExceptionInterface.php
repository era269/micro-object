<?php

declare(strict_types=1);

namespace Era269\Microobject\Exception;

use Era269\Microobject\NormalizableInterface;
use Throwable;

interface ExceptionInterface extends Throwable, NormalizableInterface
{

}
