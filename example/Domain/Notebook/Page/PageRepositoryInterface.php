<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain\Notebook\Page;


use Era269\Microobject\Example\Domain\Notebook\PageInterface;
use Era269\Microobject\IdentifierInterface;

interface PageRepositoryInterface
{
    public function get(IdentifierInterface $id): PageInterface;
}
