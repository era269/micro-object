<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook\Page;

use Era269\Microobject\Example\Domain\Notebook\PageInterface;

interface PageAwareInterface
{
    public function getPage(): PageInterface;
}
