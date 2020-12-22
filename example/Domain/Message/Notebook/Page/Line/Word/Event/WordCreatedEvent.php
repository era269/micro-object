<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event;


use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordMessage;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\CreateWordCommand;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Microobject\Message\EventInterface;

final class WordCreatedEvent extends AbstractWordMessage implements EventInterface
{
    private string $letters;

    public function __construct(CreateWordCommand $message, WordId $wordId)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
            $message->getLineId(),
            $wordId
        );
        $this->setLetters($message->getLetters());
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
