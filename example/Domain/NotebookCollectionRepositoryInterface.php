<?php
declare(strict_types=1);


namespace Era269\Example\Domain;


use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\CollectionInterface;
use Era269\Microobject\Exception\ExceptionInterface;

interface NotebookCollectionRepositoryInterface extends CollectionInterface
{
    /**
     * @return NotebookId[]
     * @throws ExceptionInterface
     */
    public function getAll(): array;

    /**
     * @throws ExceptionInterface
     */
    public function attach(NotebookId $notebookId): void;

    /**
     * @throws ExceptionInterface
     */
    public function detach(NotebookId $notebookId): void;

    /**
     * @throws ExceptionInterface
     */
    public function contains(NotebookId $notebookIdId): bool;
}
