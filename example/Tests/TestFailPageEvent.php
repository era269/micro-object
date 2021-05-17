<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Tests;

use Era269\Microobject\Example\Domain\Message\AbstractMessage;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\PageMessageInterface;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;

final class TestFailPageEvent extends AbstractMessage implements PageMessageInterface
{
    public function __construct(
        protected NotebookId $notebookId,
        protected PageId $pageId
    )
    {
        parent::__construct();
    }

    public function getNotebookId(): NotebookId
    {
        return $this->notebookId;
    }

    public function getPageId(): PageId
    {
        return $this->pageId;
    }
}
