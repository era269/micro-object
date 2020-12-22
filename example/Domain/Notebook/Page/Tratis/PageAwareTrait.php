<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Traits;


use Era269\Example\Domain\Notebook\PageInterface;

trait PageAwareTrait
{
    private PageInterface $page;

    public function getPage(): PageInterface
    {
        return $this->page;
    }

    private function setPage(PageInterface $page): void
    {
        $this->page = $page;
    }
}
