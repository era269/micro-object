<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line;


use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\CreateWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\RevertWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordCreatedEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordDeletedEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordUpdatedEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\WordReply\WordCollectionReply;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Microobject\AbstractMicroobject;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\EventInterface;
use Era269\Microobject\Message\Reply\EmptyReply;
use Era269\Microobject\Message\ReplyInterface;

final class Word extends AbstractMicroobject implements WordInterface
{
    private string $letters;
    private WordId $id;

    private function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws ExceptionInterface
     */
    public static function create(CreateWordCommand $command): self
    {
        $self = new self();
        $self->processAndSend(
            new WordCreatedEvent($command, $command->getWordId())
        );
        return $self;
    }

    /**
     * @inheritDoc
     */
    public static function denormalize(array $data): static
    {
        $self = new self();
        $self->setId(WordId::denormalize($data['id']));
        $self->setLetters($data['letters']);
        return $self;
    }

    private function setId(WordId $id): void
    {
        $this->id = $id;
    }

    private function setLetters(string $letters): void
    {
        $this->letters = $letters;
    }

    private function clearLetters(): void
    {
        $this->setLetters('');
    }


    public static function reconstitute(EventInterface ...$events): static
    {
        $self = new self();
        foreach ($events as $event) {
            $self->process($event);
        }
        return $self;
    }

    public function applyWordCreatedEvent(WordCreatedEvent $event): ReplyInterface
    {
        $this->setId($event->getWordId());
        $this->setLetters($event->getLetters());

        return new EmptyReply($event);
    }

    public function applyWordDeletedEvent(WordDeletedEvent $event): ReplyInterface
    {
        $this->clearLetters();

        return new EmptyReply($event);
    }

    public function applyWordUpdatedEvent(WordUpdatedEvent $event): ReplyInterface
    {
        $this->setLetters($event->getLetters());

        return new EmptyReply($event);
    }

    /**
     * @throws ExceptionInterface
     */
    public function revert(RevertWordCommand $command): ReplyInterface
    {
        $event = new WordUpdatedEvent($command, strrev($this->getLetters()));
        $this->processAndSend(
            $event
        );
        return new WordCollectionReply($command, $event);
    }

    private function getLetters(): string
    {
        return $this->letters;
    }

    protected function getNormalized(): array
    {
        return [
            'id' => $this->getId()->normalize(),
            'letters' => $this->getLetters(),
        ];
    }

    public function getId(): WordId
    {
        return $this->id;
    }
}
