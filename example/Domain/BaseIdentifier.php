<?php
declare(strict_types=1);


namespace Era269\Example\Domain;


use Era269\Microobject\AbstractIdentifier;

class BaseIdentifier extends AbstractIdentifier
{
    protected function generateId(): string
    {
        return uniqid();
    }
}
