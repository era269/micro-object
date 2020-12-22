<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page;


use Era269\Example\Domain\Notebook\PageInterface;
use Era269\Microobject\CollectionInterface;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\RepositoryInterface;

interface PageRepositoryInterface extends CollectionInterface, RepositoryInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function get(IdentifierInterface $id): PageInterface;

    /**
     * @throws ExceptionInterface
     */
    public function attachPage(PageInterface $page): void;
}
