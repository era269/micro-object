<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook;


use Era269\Example\Domain\BaseIdentifier;
use JetBrains\PhpStorm\Pure;

final class NotebookId extends BaseIdentifier
{
    #[Pure] protected function generateId(): string
    {
        return uniqid();
    }
}
