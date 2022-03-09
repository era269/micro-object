<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain;

use Era269\Normalizable\NormalizationFacadeAwareInterface;

interface NormalizableInterface extends \Era269\Normalizable\NormalizableInterface, NormalizationFacadeAwareInterface
{
}
