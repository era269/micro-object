<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line;


use Era269\Example\Domain\BaseIdentifier;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\AddWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\RemoveWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordAddedEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordRemovedEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Query\GetWordQuery;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\WordMessageInterface;
use Era269\Example\Domain\Message\Notebook\Page\Line\WordReply\WordCollectionReply;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordRepositoryInterface;
use Era269\Microobject\AbstractMicroobjectCollection;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\Reply\EmptyReply;
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
    public function addWord(AddWordCommand $command): ReplyInterface
    {
        $this->applyAndPublishThat(
            new WordAddedEvent($command)
        );
        return new PositiveReply($command);
    }

    /**
     * @inheritDoc
     */
    public function applyWordAddedEvent(WordAddedEvent $event): ReplyInterface
    {
        $this->attach(
            $event->getWord()
        );
        return new EmptyReply($event);
    }

    /**
     * @inheritDoc
     */
    public function applyWordRemovedEvent(WordRemovedEvent $event): ReplyInterface
    {
        $this->detach(
            $event->getWordId()
        );
        return new EmptyReply($event);
    }

    /**
     * @inheritDoc
     */
    public function removeWord(RemoveWordCommand $command): ReplyInterface
    {
        $this->applyAndPublishThat(
            new WordRemovedEvent($command)
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
            $this->getOffset($message->getWordId())
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
