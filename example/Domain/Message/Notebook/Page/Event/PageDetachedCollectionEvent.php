<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Event;


use Era269\Example\Domain\Message\Notebook\Page\AbstractPageCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Page\Command\DetachPageCollectionCommand;
use Era269\Example\Domain\Notebook\Page\PageIdAwareInterface;
use Era269\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Microobject\Message\EventInterface;

final class PageDetachedCollectionEvent extends AbstractPageCollectionMessage implements EventInterface, PageIdAwareInterface
{
    use PageIdAwareTrait;

    public function __construct(DetachPageCollectionCommand $message)
    {
        parent::__construct(
            $message->getNotebookId()
        );
        $this->setPageId(
            $message->getPageId()
        );
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'pageId' => $this->getPageId()->normalize(),
            ];
    }
}
