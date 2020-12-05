<?php

declare(strict_types=1);

namespace Era269\TrueObject;

interface IdentifierInterface extends NormalizableInterface
{
    public function equalsString(string $id): bool;

    public function equals(IdentifierInterface $other): bool;
}
