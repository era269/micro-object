<?php
declare(strict_types=1);

namespace Era269\Example\Domain;

use Era269\Example\Domain\Message\Notebook\NotebookMessageInterface;
use Era269\Example\Domain\Message\Notebook\Page\PageCollectionMessageInterface;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\MicroobjectInterface;

interface NotebookInterface extends MicroobjectInterface
{
    public function getId(): NotebookId;

    /**
     * @throws ExceptionInterface
     */
    public function processPageCollectionMessages(PageCollectionMessageInterface $message): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function processOwnMessages(NotebookMessageInterface $message): ReplyInterface;
}
