<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Command;


use Era269\Example\Domain\Message\Notebook\NotebookCollectionMessageInterface;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\NotebookIdAwareInterface;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\AbstractMessage;

final class RemoveNotebookCommand extends AbstractMessage implements NotebookCollectionMessageInterface, NotebookIdAwareInterface
{
    use NotebookIdAwareTrait;

    public function __construct(NotebookId $notebookId)
    {
        parent::__construct();
        $this->setNotebookId($notebookId);
    }
}
