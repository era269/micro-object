<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\CreatePageCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\PageMessageInterface;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Query\GetPageQuery;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\MicroobjectCollectionInterface;

interface PageCollectionInterface extends MicroobjectCollectionInterface
{
    public function getPage(GetPageQuery $query): MessageInterface;

    public function attachPage(CreatePageCommand $command): MessageInterface;

    public function processPageMessages(PageMessageInterface $message): MessageInterface;
}
