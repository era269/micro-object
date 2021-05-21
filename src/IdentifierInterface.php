<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Normalizable\ComparableInterface;
use Era269\Normalizable\NormalizableInterface;
use Stringable;

interface IdentifierInterface extends NormalizableInterface, Stringable, ComparableInterface
{

}
