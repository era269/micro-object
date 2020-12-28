<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Notebook;

use Era269\Example\Domain\Message\Notebook\Page\Command\AttachPageCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\Command\DetachPageCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\PageMessageInterface;
use Era269\Example\Domain\Message\Notebook\Page\Query\GetPageQuery;
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
    public function attachPage(AttachPageCollectionCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function detachPage(DetachPageCollectionCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function processPageMessages(PageMessageInterface $message): ReplyInterface;
}
