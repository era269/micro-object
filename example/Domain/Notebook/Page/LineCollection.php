<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page;


use Era269\Example\Domain\BaseIdentifier;
use Era269\Example\Domain\Message\Notebook\Page\Line\Command\AddLineCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Command\RemoveLineCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Event\LineAddedEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\LineMessageInterface;
use Era269\Example\Domain\Message\Notebook\Page\Line\Query\GetLineQuery;
use Era269\Example\Domain\Message\Notebook\Page\Line\Reply\LineCollectionReply;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\LineRepositoryInterface;
use Era269\Microobject\AbstractMicroobjectCollection;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\Reply\PositiveReply;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\RepositoryInterface;

final class LineCollection extends AbstractMicroobjectCollection implements LineCollectionInterface
{
    private LineRepositoryInterface $repository;

    private IdentifierInterface $id;

    private function __construct(LineId ...$ids)
    {
        parent::__construct(...$ids);
        $this->id = BaseIdentifier::create();
    }

    public static function create(LineRepositoryInterface $repository): self
    {
        return self::restore($repository);
    }

    public static function restore(LineRepositoryInterface $repository, LineId ...$notebookIds): self
    {
        $self = new self(...$notebookIds);
        $self->setRepository($repository);
        return $self;
    }

    private function setRepository(LineRepositoryInterface $repository): void
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function getLine(GetLineQuery $query): ReplyInterface
    {
        return new LineCollectionReply(
            $query,
            $this->getOffset($query->getLineId())
        );
    }

    public function addLine(AddLineCommand $command): ReplyInterface
    {
        $this->applyAndPublishThat(new LineAddedEvent($command));
        return new PositiveReply($command);
    }

    public function processLineMessages(LineMessageInterface $message): ReplyInterface
    {
        return $this->processCollectionItemMessage(
            $message,
            $this->getOffset($message->getLineId())
        );
    }

    public function removeLine(RemoveLineCommand $command): ReplyInterface
    {
        $this->detach($command->getLineId());
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
