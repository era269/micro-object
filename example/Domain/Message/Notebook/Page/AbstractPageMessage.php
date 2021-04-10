<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain\Message\Notebook\Page;


use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;

abstract class AbstractPageMessage extends AbstractPageCollectionMessage implements PageMessageInterface
{
    use PageIdAwareTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId)
    {
        parent::__construct($notebookId);
        $this->setPageId($pageId);
    }

    /**
     * @inheritDoc
     */
    protected function getNormalized(): array
    {
        return parent::getNormalized() + $this->getSelfNormalized();
    }
}
