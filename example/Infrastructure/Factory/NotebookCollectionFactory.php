<?php
declare(strict_types=1);


namespace Era269\Example\Infrastructure\Factory;


use Era269\Example\Domain\Notebook\NotebookRepositoryInterface;
use Era269\Example\Domain\NotebookCollection;
use Era269\Example\Domain\NotebookCollectionInterface;
use Era269\Example\Domain\NotebookCollectionRepositoryInterface;
use Era269\Microobject\Exception\ExceptionInterface;

final class NotebookCollectionFactory
{
    private NotebookRepositoryInterface $notebookRepository;
    private NotebookCollectionRepositoryInterface $notebookCollectionRepository;

    public function __construct(
        NotebookRepositoryInterface $notebookRepository,
        NotebookCollectionRepositoryInterface $notebookCollectionRepository
    )
    {
        $this->notebookRepository = $notebookRepository;
        $this->notebookCollectionRepository = $notebookCollectionRepository;
    }

    /**
     * @throws ExceptionInterface
     */
    public function restore(): NotebookCollectionInterface
    {
        return NotebookCollection::restore(
            $this->notebookRepository,
            ...$this->notebookCollectionRepository->getAll()
        );
    }

    public function create(): NotebookCollectionInterface
    {
        return NotebookCollection::create(
            $this->notebookRepository
        );
    }
}
