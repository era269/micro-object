<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Identifier;

class GeneratedIdentifier extends BaseIdentifier
{
    final public function __construct(string $value)
    {
        parent::__construct($value);
    }

    final public static function generate(): static
    {
        return new static(uniqid());
    }
}
