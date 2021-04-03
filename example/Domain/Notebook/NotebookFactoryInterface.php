<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\Example\Domain\Message\Notebook\Command\CreateNotebookCommand;
use Era269\Microobject\Example\Domain\NotebookInterface;
use Era269\Microobject\Message\Event\EventStreamInterface;

interface NotebookFactoryInterface
{
    public function createNotebook(CreateNotebookCommand $command): NotebookInterface;

    public function reconstituteNotebook(EventStreamInterface $eventStream): NotebookInterface;
}
