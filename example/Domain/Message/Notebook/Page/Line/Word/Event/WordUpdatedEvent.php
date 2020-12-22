<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event;


use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordMessage;
use Era269\Microobject\Message\EventInterface;

final class WordUpdatedEvent extends AbstractWordMessage implements EventInterface
{
    private string $letters;

    public function __construct(AbstractWordMessage $message, string $letters)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
            $message->getLineId(),
            $message->getWordId()
        );
        $this->setLetters($letters);
    }

    private function setLetters(string $letters): void
    {
        $this->letters = $letters;
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'letters' => $this->getLetters(),
            ];
    }

    public function getLetters(): string
    {
        return $this->letters;
    }
}
