<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Normalizable\DenormalizableInterface;
use Era269\Normalizable\NormalizableInterface;
use Stringable;

interface IdentifierInterface extends NormalizableInterface, DenormalizableInterface, Stringable
{
    public static function create(string $id): static;

    public function equals(IdentifierInterface $other): bool;
}
