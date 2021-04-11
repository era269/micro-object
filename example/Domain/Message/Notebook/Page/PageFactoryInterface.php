<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Page;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\CreatePageCommand;
use Era269\Microobject\Example\Domain\Notebook\PageInterface;
use Era269\Microobject\Message\Event\EventStreamInterface;

interface PageFactoryInterface
{
    public function createPage(CreatePageCommand $command): PageInterface;

    public function reconstitutePage(EventStreamInterface $eventStream): PageInterface;
}
