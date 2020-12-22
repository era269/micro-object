<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Notebook;

use Era269\Example\Domain\Message\Notebook\Page\Command\AddPageCommand;
use Era269\Example\Domain\Message\Notebook\Page\Command\RemovePageCommand;
use Era269\Example\Domain\Message\Notebook\Page\Event\PageAddedEvent;
use Era269\Example\Domain\Message\Notebook\Page\PageMessageInterface;
use Era269\Example\Domain\Message\Notebook\Page\Query\GetPageQuery;
use Era269\Example\Domain\Notebook\Page\Word\Message\Event\PageRemovedEvent;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\MicroobjectCollectionInterface;

interface PageCollectionInterface extends MicroobjectCollectionInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function getPage(GetPageQuery $query): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function addPage(AddPageCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function applyPageAddedEvent(PageAddedEvent $event): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function removePage(RemovePageCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function applyPageRemovedEvent(PageRemovedEvent $event): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function processPageMessages(PageMessageInterface $message): ReplyInterface;
}
