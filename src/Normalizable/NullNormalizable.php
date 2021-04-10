<?php
declare(strict_types=1);

namespace Era269\Microobject\Normalizable;

use Era269\Normalizable\Abstraction\AbstractNormalizable;

class NullNormalizable extends AbstractNormalizable
{
    /**
     * @inheritDoc
     */
    protected function getNormalized(): array
    {
        return [];
    }
}
