<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Infrastructure\Repository;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\PageFactoryInterface;
use Era269\Microobject\Example\Domain\Notebook\Page\PageRepositoryInterface;
use Era269\Microobject\Example\Domain\Notebook\PageInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\Event\EventStorageInterface;

final class PageRepository implements PageRepositoryInterface
{
    public function __construct(
        private EventStorageInterface $eventStorage,
        private PageFactoryInterface $pageFactory
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function get(IdentifierInterface $id): PageInterface
    {
        return $this->pageFactory
            ->reconstitutePage(
                $this->eventStorage->getEvents($id)
            );
    }
}
