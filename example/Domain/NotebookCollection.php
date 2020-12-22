<?php
declare(strict_types=1);


namespace Era269\Example\Domain;


use Era269\Example\Domain\Message\Notebook\Command\AddNotebookCommand;
use Era269\Example\Domain\Message\Notebook\Command\RemoveNotebookCommand;
use Era269\Example\Domain\Message\Notebook\NotebookMessageInterface;
use Era269\Example\Domain\Message\Notebook\Query\GetNotebookQuery;
use Era269\Example\Domain\Message\Notebook\Reply\NotebookCollectionReply;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\NotebookRepositoryInterface;
use Era269\Microobject\AbstractMicroobjectCollection;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\Reply\PositiveReply;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\RepositoryInterface;

final class NotebookCollection extends AbstractMicroobjectCollection implements NotebookCollectionInterface
{
    private NotebookRepositoryInterface $repository;

    private IdentifierInterface $id;

    private function __construct(NotebookId ...$ids)
    {
        parent::__construct(...$ids);
        $this->id = BaseIdentifier::create();
    }

    public static function create(NotebookRepositoryInterface $repository): self
    {
        return self::restore($repository);
    }

    public static function restore(NotebookRepositoryInterface $repository, NotebookId ...$notebookIds): self
    {
        $self = new self(...$notebookIds);
        $self->setRepository($repository);
        return $self;
    }

    private function setRepository(NotebookRepositoryInterface $repository): void
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function getNotebook(GetNotebookQuery $query): ReplyInterface
    {
        return new NotebookCollectionReply(
            $query,
            $this->getOffset($query->getNotebookId())
        );
    }

    public function addNotebook(AddNotebookCommand $command): ReplyInterface
    {
        $this->attach($command->getNotebook());
        return new PositiveReply($command);
    }

    public function applyNotebookAdded(AddNotebookCommand $command): ReplyInterface
    {
        $this->attach($command->getNotebook());
        return new PositiveReply($command);
    }

    public function processNotebookMessage(NotebookMessageInterface $message): ReplyInterface
    {
        return $this->processCollectionItemMessage(
            $message,
            $this->getOffset($message->getNotebookId())
        );
    }

    public function removeNotebook(RemoveNotebookCommand $command): ReplyInterface
    {
        $this->detach($command->getNotebookId());
        return new PositiveReply($command);
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
