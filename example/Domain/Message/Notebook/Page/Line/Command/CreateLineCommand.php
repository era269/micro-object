<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line\Command;

use Era269\Example\Domain\Message\Notebook\Page\Line\LineMessageInterface;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\Traits\LineIdAwareTrait;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\AbstractMessage;

final class CreateLineCommand extends AbstractMessage implements LineMessageInterface
{
    use NotebookIdAwareTrait;
    use PageIdAwareTrait;
    use LineIdAwareTrait;

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
