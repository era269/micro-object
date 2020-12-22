<?php
declare(strict_types=1);


namespace Era269\Example\Domain;


use Era269\Microobject\AbstractIdentifier;
use JetBrains\PhpStorm\Pure;

class BaseIdentifier extends AbstractIdentifier
{
    #[Pure]
    protected function generateId(): string
    {
        return uniqid();
    }
}
