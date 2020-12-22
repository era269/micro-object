<?php
declare(strict_types=1);

namespace Era269\Microobject\Normalizable;

use Era269\Microobject\AbstractNormalizableModel;
use Era269\Microobject\NormalizableInterface;

class NullNormalizable extends AbstractNormalizableModel implements NormalizableInterface
{

    /**
     * @inheritDoc
     */
    protected function getNormalized(): array
    {
        return [];
    }
}
