<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page;


use Era269\Example\Domain\Message\Notebook\Page\Line\Word\WordCollectionMessageInterface;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\WordCollectionInterface;
use Era269\Microobject\AbstractMicroobject;
use Era269\Microobject\Message\ReplyInterface;

final class Line extends AbstractMicroobject implements LineInterface
{
    private WordCollectionInterface $words;
    private LineId $id;

    public function __construct(LineId $id, WordCollectionInterface $words)
    {
        parent::__construct($words);

        $this->id = $id;
        $this->words = $words;
    }

    /**
     * @inheritDoc
     */
    public function processWordCollectionMessages(WordCollectionMessageInterface $message): ReplyInterface
    {
        return $this->words->process($message);
    }

    /**
     * @inheritDoc
     */
    protected function getNormalized(): array
    {
        return [
            'id' => $this->getId()->normalize(),
            'words' => $this->words->normalize(),
        ];
    }

    public function getId(): LineId
    {
        return $this->id;
    }
}
