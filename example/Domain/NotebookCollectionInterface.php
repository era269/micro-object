<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain;


use Era269\Microobject\Example\Domain\Message\Notebook\Command\CreateNotebookCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\NotebookMessageInterface;
use Era269\Microobject\Example\Domain\Message\Notebook\Query\GetNotebookQuery;
use Era269\Microobject\Exception\MicroobjectExceptionInterface;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\MicroobjectCollectionInterface;

interface NotebookCollectionInterface extends MicroobjectCollectionInterface
{
    /**
     * @throws MicroobjectExceptionInterface
     */
    public function getNotebook(GetNotebookQuery $query): MessageInterface;

    /**
     * @throws MicroobjectExceptionInterface
     */
    public function attachNotebook(CreateNotebookCommand $command): MessageInterface;

    /**
     * @throws MicroobjectExceptionInterface
     */
    public function processNotebookMessage(NotebookMessageInterface $message): MessageInterface;
}
