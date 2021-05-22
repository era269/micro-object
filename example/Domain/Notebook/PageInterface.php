<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\AddLineCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Query\GetTextQuery;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\MicroobjectInterface;

interface PageInterface extends MicroobjectInterface
{
    /**
     * @inheritDoc
     */
    public function getId(): PageId;

    public function addLine(AddLineCommand $command): MessageInterface;

    public function getText(GetTextQuery $query): MessageInterface;
}
