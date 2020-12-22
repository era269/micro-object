<?php
declare(strict_types=1);

namespace Era269\Microobject\Identifier;

use Era269\Microobject\AbstractIdentifier;
use Era269\Microobject\IdentifierInterface;

class NullIdentifier extends AbstractIdentifier implements IdentifierInterface
{
    protected function generateId(): string
    {
        return '';
    }
}
