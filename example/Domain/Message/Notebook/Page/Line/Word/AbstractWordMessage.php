<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word;


use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\Traits\WordIdAwareTrait;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Example\Domain\Notebook\Page\PageId;

abstract class AbstractWordMessage extends AbstractWordCollectionMessage implements WordMessageInterface
{
    use WordIdAwareTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId, LineId $lineId, WordId $wordId)
    {
        parent::__construct($notebookId, $pageId, $lineId);
        $this->setWordId($wordId);
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'wordId' => $this->getWordId()->normalize(),
            ];
    }
}
