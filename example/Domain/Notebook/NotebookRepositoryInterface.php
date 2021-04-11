<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\Example\Domain\NotebookInterface;
use Era269\Microobject\IdentifierInterface;

interface NotebookRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function get(IdentifierInterface $id): NotebookInterface;
}
