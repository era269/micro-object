<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Page;

use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Normalizable\Traits\NormalizableTrait;

abstract class AbstractPageMessage extends AbstractPageCollectionMessage implements PageMessageInterface
{
    use PageIdAwareTrait;
    use NormalizableTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId)
    {
        parent::__construct($notebookId);
        $this->setPageId($pageId);
    }
}
