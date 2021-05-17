<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook;

use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;

abstract class AbstractNotebookMessage extends AbstractNotebookCollectionMessage implements NotebookMessageInterface
{
    use NotebookIdAwareTrait;

    public function __construct(NotebookId $notebookId)
    {
        parent::__construct();
        $this->setNotebookId($notebookId);
    }
}
