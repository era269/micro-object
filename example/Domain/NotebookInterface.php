<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\PageCollectionMessageInterface;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\MicroobjectInterface;

interface NotebookInterface extends MicroobjectInterface
{
    public function getId(): NotebookId;

    public function processPageCollectionMessages(PageCollectionMessageInterface $message): MessageInterface;
}
