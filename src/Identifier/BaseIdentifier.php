<?php

declare(strict_types=1);

namespace Era269\Microobject\Identifier;

use Era269\Microobject\IdentifierInterface;
use Era269\Normalizable\AbstractNormalizableObject;

class BaseIdentifier extends AbstractNormalizableObject implements IdentifierInterface
{
    private const FIELD_NAME_VALUE = 'value';

    public function __construct(
        private string $value
    ) {

    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function equals(IdentifierInterface $other): bool
    {
        return (string)$other === (string)$this;
    }

    /**
     * @inheritDoc
     */
    protected function getNormalized(): array
    {
        return [
            self::FIELD_NAME_VALUE => $this->value
        ];
    }
}
