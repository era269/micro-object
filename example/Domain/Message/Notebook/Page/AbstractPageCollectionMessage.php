<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Page;

use Era269\Microobject\Example\Domain\Message\AbstractMessage;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Normalizable\Traits\NormalizableTrait;

abstract class AbstractPageCollectionMessage extends AbstractMessage implements PageCollectionMessageInterface
{
    use NotebookIdAwareTrait;
    use NormalizableTrait;

    public function __construct(NotebookId $notebookId)
    {
        parent::__construct();
        $this->setNotebookId($notebookId);
    }
}
