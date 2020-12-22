<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line\WordReply;

use Era269\Example\Domain\Message\Notebook\Page\Line\Word\WordCollectionMessageInterface;
use Era269\Example\Domain\Notebook\Page\Line\Traits\LineIdAwareTrait;
use Era269\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\Reply\BaseReply;
use Era269\Microobject\NormalizableInterface;

final class WordCollectionReply extends BaseReply implements WordCollectionMessageInterface
{
    use NotebookIdAwareTrait;
    use PageIdAwareTrait;
    use LineIdAwareTrait;

    public function __construct(WordCollectionMessageInterface $message, NormalizableInterface $payload)
    {
        parent::__construct($message, $payload);
        $this->setNotebookId($message->getNotebookId());
        $this->setPageId($message->getPageId());
        $this->setLineId($message->getLineId());
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
