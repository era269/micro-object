<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Notebook;

use Era269\Example\Domain\Message\Notebook\Page\Line\LineCollectionMessageInterface;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\MicroobjectInterface;

interface PageInterface extends MicroobjectInterface, NotebookIdAwareInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function processLineCollectionMessages(LineCollectionMessageInterface $message): ReplyInterface;

    public function getId(): PageId;
}
