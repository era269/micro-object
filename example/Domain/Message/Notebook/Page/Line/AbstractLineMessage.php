<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line;


use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\Traits\LineIdAwareTrait;
use Era269\Example\Domain\Notebook\Page\PageId;

abstract class AbstractLineMessage extends AbstractLineCollectionMessage implements LineMessageInterface
{
    use LineIdAwareTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId, LineId $lineId)
    {
        parent::__construct($notebookId, $pageId);
        $this->setLineId($lineId);
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'lineId' => $this->getLineId()->normalize(),
            ];
    }
}
