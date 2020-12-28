<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Command;


use Era269\Example\Domain\Message\Notebook\Page\AbstractPageCollectionMessage;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Example\Domain\Notebook\Page\PageIdAwareInterface;
use Era269\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;

final class DetachPageCollectionCommand extends AbstractPageCollectionMessage implements PageIdAwareInterface
{
    use PageIdAwareTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId)
    {
        parent::__construct($notebookId);
        $this->setPageId($pageId);
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'pageId' => $this->getPageId(),
            ];
    }


}
