<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Notebook\Page;

use Era269\Example\Domain\Message\Notebook\Page\Line\Command\AddLineCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Command\RemoveLineCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\LineMessageInterface;
use Era269\Example\Domain\Message\Notebook\Page\Line\Query\GetLineQuery;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\MicroobjectCollectionInterface;

interface LineCollectionInterface extends MicroobjectCollectionInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function getLine(GetLineQuery $query): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function addLine(AddLineCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function removeLine(RemoveLineCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function processLineMessages(LineMessageInterface $message): ReplyInterface;
}
