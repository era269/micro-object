<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\AddLineCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Query\GetTextQuery;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\Message\ResponseInterface;
use Era269\Microobject\MicroobjectInterface;

interface PageInterface extends MicroobjectInterface
{
    public function getId(): PageId;

    public function addLine(AddLineCommand $command): ResponseInterface;

    public function getText(GetTextQuery $query): ResponseInterface;
}
