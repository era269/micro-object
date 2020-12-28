<?php
declare(strict_types=1);


namespace Era269\Example\Domain;


use Era269\Example\Domain\Message\Notebook\Command\AttachNotebookCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Command\DetachNotebookCollectionCommand;
use Era269\Example\Domain\Message\Notebook\NotebookMessageInterface;
use Era269\Example\Domain\Message\Notebook\Query\GetNotebookQuery;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\IdentifierCollectionAwareInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\MicroobjectCollectionInterface;

interface NotebookCollectionInterface extends MicroobjectCollectionInterface, IdentifierCollectionAwareInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function getNotebook(GetNotebookQuery $query): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function attachNotebook(AttachNotebookCollectionCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function detachNotebook(DetachNotebookCollectionCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function processNotebookMessage(NotebookMessageInterface $message): ReplyInterface;
}
