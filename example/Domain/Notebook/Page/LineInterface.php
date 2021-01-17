<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Notebook\Page;

use Era269\Example\Domain\Message\Notebook\Page\Line\Word\WordCollectionMessageInterface;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\MicroobjectInterface;

interface LineInterface extends MicroobjectInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function processWordCollectionMessages(WordCollectionMessageInterface $message): ReplyInterface;

    public function getId(): LineId;
}
