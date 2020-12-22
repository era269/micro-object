<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command;

use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordCollectionMessage;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\Traits\WordAwareTrait;
use Era269\Example\Domain\Notebook\Page\Line\Word;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordAwareInterface;
use Era269\Example\Domain\Notebook\Page\Line\WordInterface;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\DenormalizableInterface;
use Era269\Microobject\Exception\ExceptionInterface;

final class AddWordCommand extends AbstractWordCollectionMessage implements WordAwareInterface, DenormalizableInterface
{
    use WordAwareTrait;

    private string $letters;

    public function __construct(NotebookId $notebookId, PageId $pageId, LineId $lineId, WordInterface $word)
    {
        parent::__construct($notebookId, $pageId, $lineId);
        $this->setWord($word);
    }

    /**
     * @param array $data
     * @return static
     * @throws ExceptionInterface
     */
    public static function denormalize(array $data): self
    {
        return new self(
            NotebookId::denormalize($data['notebookId']),
            PageId::denormalize($data['pageId']),
            LineId::denormalize($data['lineId']),
            Word::create(
                CreateWordCommand::denormalize($data)
            )
        );
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'word' => $this->getWord()->normalize(),
            ];
    }

}
