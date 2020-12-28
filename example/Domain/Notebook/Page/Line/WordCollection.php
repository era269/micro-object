<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line;


use Era269\Example\Domain\BaseIdentifier;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\AttachWordCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\DetachWordCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordAttachedCollectionEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordDeletedEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordDetachedCollectionEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Query\GetWordQuery;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\WordMessageInterface;
use Era269\Example\Domain\Message\Notebook\Page\Line\WordReply\WordCollectionReply;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordRepositoryInterface;
use Era269\Microobject\AbstractMicroobjectCollection;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\EventInterface;
use Era269\Microobject\Message\Reply\PositiveReply;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\RepositoryInterface;

final class WordCollection extends AbstractMicroobjectCollection implements WordCollectionInterface
{
    private WordRepositoryInterface $repository;

    private IdentifierInterface $id;

    private function __construct(WordId ...$wordIds)
    {
        parent::__construct(...$wordIds);
        $this->id = BaseIdentifier::create();
    }

    public static function create(WordRepositoryInterface $repository): self
    {
        return self::restore($repository);
    }

    public static function restore(WordRepositoryInterface $repository, WordId ...$wordIds): self
    {
        $self = new self(...$wordIds);
        $self->setRepository($repository);

        return $self;
    }

    private function setRepository(WordRepositoryInterface $repository): void
    {
        $this->repository = $repository;
    }

    /**
     * @throws ExceptionInterface
     */
    public static function reconstitute(WordRepositoryInterface $repository, EventInterface ...$events): self
    {
        $self = new self();
        foreach ($events as $event) {
            $self->process($event);
        }
        $self->setRepository($repository);

        return $self;
    }

    /**
     * @inheritDoc
     */
    public function getWord(GetWordQuery $query): ReplyInterface
    {
        return new WordCollectionReply(
            $query,
            $this->getOffset($query->getWordId())
        );
    }

    /**
     * @inheritDoc
     */
    public function attachWord(AttachWordCollectionCommand $command): ReplyInterface
    {
        $this->attach(
            $command->getWord()
        );
        $this->processAndSend(
            new WordAttachedCollectionEvent($command)
        );
        return new PositiveReply($command);
    }

    public function applyWordAttachedEvent(WordAttachedCollectionEvent $event): void
    {
        $this->attachIdentifier(
            $event->getWordId()
        );
    }

    public function applyWordDetachedEvent(WordDetachedCollectionEvent $event): void
    {
        $this->detachIdentifier(
            $event->getWordId()
        );
    }

    /**
     * @throws ExceptionInterface
     */
    public function applyWordDeletedEvent(WordDeletedEvent $event): void
    {
        $this->process(
            DetachWordCollectionCommand::formWordMessage($event)
        );
    }

    /**
     * @inheritDoc
     */
    public function detachWord(DetachWordCollectionCommand $command): ReplyInterface
    {
        $this->detach(
            $this->getOffset(
                $command->getWordId()
            )
        );
        $this->processAndSend(
            new WordDetachedCollectionEvent($command)
        );
        return new PositiveReply($command);
    }

    /**
     * @inheritDoc
     */
    public function processWordMessages(WordMessageInterface $message): ReplyInterface
    {
        return $this->processCollectionItemMessage(
            $message,
            $message->getWordId()
        );
    }

    public function getId(): IdentifierInterface
    {
        return $this->id;
    }

    protected function getRepository(): RepositoryInterface
    {
        return $this->repository;
    }
}
