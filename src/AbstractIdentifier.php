<?php

declare(strict_types=1);

namespace Era269\Microobject;

abstract class AbstractIdentifier extends AbstractNormalizableModel implements IdentifierInterface
{
    private string $id;

    private function __construct(string $id = null)
    {
        $this->id = $id ?? $this->generateId();
    }

    public static function create(): static
    {
        return new static();
    }

    public static function denormalize(string $id): static
    {
        return new static($id);
    }

    abstract protected function generateId(): string;

    public function equalsString(string $id): bool
    {
        return $this->toString() === $id;
    }

    private function toString(): string
    {
        return $this->id;
    }

    public function equals(IdentifierInterface $other): bool
    {
        return $other->equalsString($this->toString());
    }

    protected function getNormalized(): array
    {
        return [
            'id' => $this->id
        ];
    }
}
