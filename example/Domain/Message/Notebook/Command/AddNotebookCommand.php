<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Command;


use Era269\Example\Domain\Message\Notebook\NotebookCollectionMessageInterface;
use Era269\Example\Domain\Notebook\NotebookAwareInterface;
use Era269\Example\Domain\Notebook\Traits\NotebookAwareTrait;
use Era269\Example\Domain\NotebookInterface;
use Era269\Microobject\Message\AbstractMessage;

final class AddNotebookCommand extends AbstractMessage implements NotebookCollectionMessageInterface, NotebookAwareInterface
{
    use NotebookAwareTrait;

    public function __construct(NotebookInterface $notebook)
    {
        parent::__construct();
        $this->setNotebook($notebook);
    }
}
