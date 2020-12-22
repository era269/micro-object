<?php

declare(strict_types=1);

namespace Era269\Microobject;

interface IdentifierInterface extends NormalizableInterface
{
    public static function create(): static;

    public static function denormalize(string $id): static;

    public function equalsString(string $id): bool;

    public function equals(IdentifierInterface $other): bool;
}
