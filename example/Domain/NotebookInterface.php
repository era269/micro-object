<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\PageCollectionMessageInterface;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Exception\MicroobjectExceptionInterface;
use Era269\Microobject\Message\ResponseInterface;
use Era269\Microobject\MicroobjectInterface;

interface NotebookInterface extends MicroobjectInterface
{
    public function getId(): NotebookId;

    /**
     * @throws MicroobjectExceptionInterface
     */
    public function processPageCollectionMessages(PageCollectionMessageInterface $message): ResponseInterface;
}
