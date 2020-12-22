<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Notebook\Page\Traits;

use Era269\Example\Domain\Notebook\Page\PageId;

trait PageIdAwareTrait
{
    private PageId $pageId;

    public function getPageId(): PageId
    {
        return $this->pageId;
    }

    private function setPageId(PageId $pageId): void
    {
        $this->pageId = $pageId;
    }
}
