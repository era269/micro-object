<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain\Notebook;


use Era269\Microobject\Example\Domain\NotebookCollection;
use Era269\Microobject\Example\Domain\NotebookCollectionInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

final class NotebookCollectionFactory
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private NotebookRepositoryInterface $notebookRepository,
        private NotebookFactoryInterface $notebookFactory
    ) {
    }

    public function create(): NotebookCollectionInterface
    {
        return NotebookCollection::create(
            $this->eventDispatcher,
            $this->notebookRepository,
            $this->notebookFactory
        );
    }
}
