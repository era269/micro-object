<?php
declare(strict_types=1);


namespace Era269\Example\Domain;


use Era269\Example\Domain\Message\Notebook\Command\AddNotebookCommand;
use Era269\Example\Domain\Message\Notebook\Command\RemoveNotebookCommand;
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
    public function addNotebook(AddNotebookCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function removeNotebook(RemoveNotebookCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function processNotebookMessage(NotebookMessageInterface $message): ReplyInterface;
}
