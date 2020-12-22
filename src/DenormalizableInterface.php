<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Exception\DenormalizingException;
use TypeError;

interface DenormalizableInterface extends NormalizableInterface
{
    /**
     * @param array[] $data
     * @throws DenormalizingException
     * @throws TypeError
     */
    public static function denormalize(array $data): self;
}
