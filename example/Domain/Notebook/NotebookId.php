<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\Example\Domain\Identifier\GeneratedIdentifier;

final class NotebookId extends GeneratedIdentifier
{
    protected function generateId(): string
    {
        return uniqid();
    }
}
