<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Infrastructure\Repository;

use Era269\Microobject\Example\Domain\Notebook\NotebookFactoryInterface;
use Era269\Microobject\Example\Domain\Notebook\NotebookRepositoryInterface;
use Era269\Microobject\Example\Domain\NotebookInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\Event\EventStorageInterface;

final class NotebookRepository implements NotebookRepositoryInterface
{
    public function __construct(
        private EventStorageInterface $eventStorage,
        private NotebookFactoryInterface $notebookFactory
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function get(IdentifierInterface $id): NotebookInterface
    {
        return $this->notebookFactory
            ->reconstituteNotebook(
                $this->eventStorage->getEvents($id)
            );
    }
}
