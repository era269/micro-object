<?php

declare(strict_types=1);

namespace Era269\TrueObject;

use RuntimeException;

abstract class AbstractIdentifier extends AbstractNormalizableModel implements IdentifierInterface
{
    private string $id;

    public function __construct()
    {
        $uuid = uuid_create();
        if (is_null($uuid)) {
            throw new RuntimeException('Cannot generate uuid');
        }
        $this->id = $uuid;
    }

    public function equalsString(string $id)
    : bool
    {
        return $this->toString() === $id;
    }

    public function equals(IdentifierInterface $other)
    : bool
    {
        return $other->equalsString($this->toString());
    }

    protected function getNormalized()
    : array
    {
        return [
            'id' => $this->id
        ];
    }

    private function toString()
    : string
    {
        return $this->id;
    }
}
