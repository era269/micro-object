<?php

declare(strict_types=1);

namespace Era269\TrueObject;

use Era269\TrueObject\Traits\AbstractNormalizableTrait;

abstract class AbstractNormalizableModel implements NormalizableInterface
{
    use AbstractNormalizableTrait;
}
