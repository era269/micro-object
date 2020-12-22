<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\Microobject\NormalizableInterface;

trait AbstractNormalizableTrait
{
    /**
     * @return array<string, string|int|array|bool|float|null>
     */
    public function normalize(): array
    {
        return [NormalizableInterface::FIELD_NAME_DOMAIN_MODEL_NAME => static::class] + $this->getNormalized();
    }

    /**
     * @return array<string, string|int|array|bool|float|null>
     */
    abstract protected function getNormalized(): array;
}
