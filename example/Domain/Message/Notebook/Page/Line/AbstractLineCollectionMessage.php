<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line;


use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\AbstractMessage;

abstract class AbstractLineCollectionMessage extends AbstractMessage implements LineCollectionMessageInterface
{
    use PageIdAwareTrait;
    use NotebookIdAwareTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId)
    {
        parent::__construct();
        $this->setNotebookId($notebookId);
        $this->setPageId($pageId);
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'notebookId' => $this->getNotebookId()->normalize(),
                'pageId' => $this->getPageId()->normalize(),
            ];
    }
}
