<?php

declare(strict_types=1);

namespace Era269\TrueObject\Traits;

use Era269\TrueObject\NormalizableInterface;

trait AbstractNormalizableTrait
{
    /**
     * @return array<string, string|int|array|bool|float|null>
     */
    public function normalized(): array
    {
        return [NormalizableInterface::FIELD_NAME_DOMAIN_MODEL_NAME => static::class] + $this->getNormalized();
    }

    /**
     * @return array<string, string|int|array|bool|float|null>
     */
    abstract protected function getNormalized(): array;
}
