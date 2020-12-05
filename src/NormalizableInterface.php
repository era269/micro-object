<?php

declare(strict_types=1);

namespace Era269\TrueObject;

interface NormalizableInterface
{
    public const FIELD_NAME_DOMAIN_MODEL_NAME = '@type';

    /**
     * @return array<string, string|int|array|bool|float|null>
     */
    public function normalized(): array;
}
