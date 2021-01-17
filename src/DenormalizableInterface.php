<?php

declare(strict_types=1);

namespace Era269\Microobject;

use InvalidArgumentException;
use TypeError;

interface DenormalizableInterface extends NormalizableInterface
{
    /**
     * @param array[] $data
     * @throws InvalidArgumentException
     * @throws TypeError
     */
    public static function denormalize(array $data): static;
}
