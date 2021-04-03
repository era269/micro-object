<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Identifier;


use Era269\Microobject\AbstractIdentifier;
use LogicException;

final class NativeIdentifier extends AbstractIdentifier
{

    protected function generateId(): NativeIdentifier
    {
        throw new LogicException('Native identifier cannot be generated. ');
    }
}
