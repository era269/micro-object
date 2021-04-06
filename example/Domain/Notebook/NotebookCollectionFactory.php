<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\Example\Domain\NotebookCollection;
use Era269\Microobject\Example\Domain\NotebookCollectionInterface;

final class NotebookCollectionFactory
{
    public function __construct(
        private NotebookRepositoryInterface $notebookRepository,
        private NotebookFactoryInterface $notebookFactory
    ) {
    }

    public function create(): NotebookCollectionInterface
    {
        return NotebookCollection::create(
            $this->notebookRepository,
            $this->notebookFactory
        );
    }
}
