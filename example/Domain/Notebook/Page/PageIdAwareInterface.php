<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page;


interface PageIdAwareInterface
{
    public function getPageId(): PageId;
}
