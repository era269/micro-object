<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook;


use Era269\Example\Domain\NotebookInterface;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\RepositoryInterface;

interface NotebookRepositoryInterface extends RepositoryInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function get(IdentifierInterface $id): NotebookInterface;
    /**
     * @throws ExceptionInterface
     */
    public function attachNotebook(NotebookInterface $notebook): void;
}
