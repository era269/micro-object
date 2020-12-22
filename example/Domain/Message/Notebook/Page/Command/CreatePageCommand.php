<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Command;


use Era269\Example\Domain\Message\Notebook\Page\PageCollectionMessageInterface;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Example\Domain\Notebook\Page\PageIdAwareInterface;
use Era269\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\AbstractMessage;

final class CreatePageCommand extends AbstractMessage implements PageCollectionMessageInterface, PageIdAwareInterface
{
    use NotebookIdAwareTrait;
    use PageIdAwareTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId)
    {
        parent::__construct();
        $this->setNotebookId($notebookId);
        $this->setPageId($pageId);
    }
}
