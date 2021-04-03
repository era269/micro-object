<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\CreatePageCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\PageMessageInterface;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Query\GetPageQuery;
use Era269\Microobject\Exception\MicroobjectExceptionInterface;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\MicroobjectCollectionInterface;

interface PageCollectionInterface extends MicroobjectCollectionInterface
{
    /**
     * @throws MicroobjectExceptionInterface
     */
    public function getPage(GetPageQuery $query): MessageInterface;

    /**
     * @throws MicroobjectExceptionInterface
     */
    public function attachPage(CreatePageCommand $command): MessageInterface;

    /**
     * @throws MicroobjectExceptionInterface
     */
    public function processPageMessages(PageMessageInterface $message): MessageInterface;
}
