<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain\Notebook\Page;


interface PageIdAwareInterface
{
    public function getPageId(): PageId;
}
