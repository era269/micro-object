<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command;

use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordMessage;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\DenormalizableInterface;

final class CreateWordCommand extends AbstractWordMessage implements DenormalizableInterface
{
    private string $letters;

    public function __construct(NotebookId $notebookId, PageId $pageId, LineId $lineId, WordId $wordId, string $letters)
    {
        parent::__construct($notebookId, $pageId, $lineId, $wordId);
        $this->letters = $letters;
    }

    public function getLetters(): string
    {
        return $this->letters;
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'letters' => $this->letters,
            ];
    }

    public static function denormalize(array $data): self
    {
        return new self(
            NotebookId::denormalize($data['notebookId']),
            PageId::denormalize($data['pageId']),
            LineId::denormalize($data['lineId']),
            WordId::denormalize($data['word']['id']),
            $data['word']['letters'],
        );
    }
}
