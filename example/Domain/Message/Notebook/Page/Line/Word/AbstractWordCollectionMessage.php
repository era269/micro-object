<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word;


use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\Traits\LineIdAwareTrait;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\AbstractMessage;

abstract class AbstractWordCollectionMessage extends AbstractMessage implements WordCollectionMessageInterface
{
    use LineIdAwareTrait;
    use PageIdAwareTrait;
    use NotebookIdAwareTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId, LineId $lineId)
    {
        parent::__construct();
        $this->setNotebookId($notebookId);
        $this->setPageId($pageId);
        $this->setLineId($lineId);
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'notebookId' => $this->getNotebookId()->normalize(),
                'pageId' => $this->getPageId()->normalize(),
                'lineId' => $this->getLineId()->normalize(),
            ];
    }
}
