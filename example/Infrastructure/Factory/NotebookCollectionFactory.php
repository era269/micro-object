<?php
declare(strict_types=1);


namespace Era269\Example\Infrastructure\Factory;


use Era269\Example\Domain\Notebook\NotebookRepositoryInterface;
use Era269\Example\Domain\NotebookCollection;
use Era269\Example\Domain\NotebookCollectionInterface;

final class NotebookCollectionFactory
{
    private NotebookRepositoryInterface $notebookRepository;

    public function __construct(
        NotebookRepositoryInterface $notebookRepository,
    )
    {
        $this->notebookRepository = $notebookRepository;
    }

    public function create(): NotebookCollectionInterface
    {
        return NotebookCollection::create(
            $this->notebookRepository
        );
    }
}
