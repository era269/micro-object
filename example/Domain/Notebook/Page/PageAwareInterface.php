<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page;


use Era269\Example\Domain\Notebook\PageInterface;

interface PageAwareInterface
{
    public function getPage(): PageInterface;
}
