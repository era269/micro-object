<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Traits\AbstractNormalizableTrait;

abstract class AbstractNormalizableModel implements NormalizableInterface
{
    use AbstractNormalizableTrait;
}
