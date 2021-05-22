<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\Example\Domain\Message\Notebook\Command\CreateNotebookCommand;
use Era269\Microobject\Example\Domain\Notebook;
use Era269\Microobject\Example\Domain\NotebookInterface;
use Era269\Microobject\Message\Event\EventStreamInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

final class NotebookFactory implements NotebookFactoryInterface
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher,
        private PageCollectionInterface $pageCollection
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function createNotebook(CreateNotebookCommand $command): NotebookInterface
    {
        return Notebook::create(
            $this->eventDispatcher,
            $this->pageCollection,
            $command
        );
    }

    /**
     * @inheritDoc
     */
    public function reconstituteNotebook(EventStreamInterface $eventStream): NotebookInterface
    {
        return Notebook::reconstitute(
            $this->eventDispatcher,
            $this->pageCollection,
            $eventStream
        );
    }
}
