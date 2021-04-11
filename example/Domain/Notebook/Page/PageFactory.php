<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook\Page;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\CreatePageCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\PageFactoryInterface;
use Era269\Microobject\Example\Domain\Notebook\Page;
use Era269\Microobject\Example\Domain\Notebook\PageInterface;
use Era269\Microobject\Message\Event\EventStreamInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

final class PageFactory implements PageFactoryInterface
{
    public function __construct(
        private EventDispatcherInterface $eventDispatcher
    )
    {
    }

    public function createPage(CreatePageCommand $command): PageInterface
    {
        return Page::create(
            $this->eventDispatcher,
            $command
        );
    }

    public function reconstitutePage(EventStreamInterface $eventStream): PageInterface
    {
        return Page::reconstitute(
            $this->eventDispatcher,
            $eventStream
        );
    }
}
