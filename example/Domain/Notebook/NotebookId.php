<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook;


use Era269\Example\Domain\BaseIdentifier;

final class NotebookId extends BaseIdentifier
{
    protected function generateId(): string
    {
        return uniqid();
    }
}
