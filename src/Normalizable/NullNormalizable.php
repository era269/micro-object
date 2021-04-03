<?php
declare(strict_types=1);

namespace Era269\Microobject\Normalizable;

use Era269\Normalizable\AbstractNormalizableObject;

class NullNormalizable extends AbstractNormalizableObject
{
    /**
     * @inheritDoc
     */
    protected function getNormalized(): array
    {
        return [];
    }
}
