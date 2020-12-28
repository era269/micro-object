<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Event;


use Era269\Example\Domain\Message\Notebook\Page\AbstractPageCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Page\Command\AttachPageCollectionCommand;
use Era269\Example\Domain\Notebook\Page\PageIdAwareInterface;
use Era269\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Microobject\Message\EventInterface;

final class PageAttachedCollectionEvent extends AbstractPageCollectionMessage implements EventInterface, PageIdAwareInterface
{
    use PageIdAwareTrait;

    public function __construct(AttachPageCollectionCommand $message)
    {
        parent::__construct(
            $message->getNotebookId(),
        );
        $this->setPageId(
            $message->getPage()->getId()
        );
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'pageId' => $this->getPageId()->normalize(),
            ];
    }
}
