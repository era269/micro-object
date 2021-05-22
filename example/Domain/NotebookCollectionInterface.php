<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain;

use Era269\Microobject\Example\Domain\Message\Notebook\Command\CreateNotebookCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\NotebookMessageInterface;
use Era269\Microobject\Example\Domain\Message\Notebook\Query\GetNotebookQuery;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\MicroobjectCollectionInterface;

interface NotebookCollectionInterface extends MicroobjectCollectionInterface
{
    public function getNotebook(GetNotebookQuery $query): MessageInterface;

    public function attachNotebook(CreateNotebookCommand $command): MessageInterface;

    public function processNotebookMessage(NotebookMessageInterface $message): MessageInterface;
}
