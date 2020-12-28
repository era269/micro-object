<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command;

use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\WordMessageInterface;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\Traits\WordIdAwareTrait;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordIdAwareInterface;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\DenormalizableInterface;

final class DetachWordCollectionCommand extends AbstractWordCollectionMessage implements WordIdAwareInterface, DenormalizableInterface
{
    use WordIdAwareTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId, LineId $lineId, WordId $wordId)
    {
        parent::__construct($notebookId, $pageId, $lineId);
        $this->setWordId($wordId);
    }

    public static function formWordMessage(WordMessageInterface $message): self
    {
        return new self(
            $message->getNotebookId(),
            $message->getPageId(),
            $message->getLineId(),
            $message->getWordId()
        );
    }

    public static function denormalize(array $data): static
    {
        return new self(
            NotebookId::denormalize($data['notebookId']),
            PageId::denormalize($data['pageId']),
            LineId::denormalize($data['lineId']),
            WordId::denormalize($data['wordId']),
        );
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'wordId' => $this->getWordId()->normalize(),
            ];
    }
}
