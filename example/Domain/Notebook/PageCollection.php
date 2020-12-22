<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook;


use Era269\Example\Domain\BaseIdentifier;
use Era269\Example\Domain\Message\Notebook\Page\Command\AddPageCommand;
use Era269\Example\Domain\Message\Notebook\Page\Command\RemovePageCommand;
use Era269\Example\Domain\Message\Notebook\Page\Event\PageAddedEvent;
use Era269\Example\Domain\Message\Notebook\Page\PageMessageInterface;
use Era269\Example\Domain\Message\Notebook\Page\Query\GetPageQuery;
use Era269\Example\Domain\Message\Notebook\Page\Reply\PageCollectionReply;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Example\Domain\Notebook\Page\PageRepositoryInterface;
use Era269\Example\Domain\Notebook\Page\Word\Message\Event\PageRemovedEvent;
use Era269\Microobject\AbstractMicroobjectCollection;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\Reply\EmptyReply;
use Era269\Microobject\Message\Reply\PositiveReply;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\RepositoryInterface;
use Era269\Microobject\Traits\IdentifierCollectionAwareTrait;

final class PageCollection extends AbstractMicroobjectCollection implements PageCollectionInterface
{
    use IdentifierCollectionAwareTrait;

    private PageRepositoryInterface $repository;

    private IdentifierInterface $id;

    private function __construct(NotebookId ...$ids)
    {
        parent::__construct(...$ids);
        $this->id = BaseIdentifier::create();
    }

    public static function create(PageRepositoryInterface $repository): self
    {
        return self::restore($repository);
    }

    public static function restore(PageRepositoryInterface $repository, PageId ...$notebookIds): self
    {
        $self = new self(...$notebookIds);
        $self->setRepository($repository);
        return $self;
    }

    private function setRepository(PageRepositoryInterface $repository): void
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function getPage(GetPageQuery $query): ReplyInterface
    {
        return new PageCollectionReply(
            $query,
            $this->getOffset($query->getPageId())
        );
    }

    public function addPage(AddPageCommand $command): ReplyInterface
    {
        $this->applyAndPublishThat(new PageAddedEvent($command));
        return new PositiveReply($command);
    }

    /**
     * @inheritDoc
     */
    public function applyPageAddedEvent(PageAddedEvent $event): ReplyInterface
    {
        $this->attach($event->getPage());
        return new EmptyReply($event);
    }

    public function processPageMessages(PageMessageInterface $message): ReplyInterface
    {
        return $this->processCollectionItemMessage(
            $message,
            $this->getOffset($message->getPageId())
        );
    }

    /**
     * @inheritDoc
     */
    public function applyPageRemovedEvent(PageRemovedEvent $event): ReplyInterface
    {
        $this->detach($event->getPageId());
        return new EmptyReply($event);
    }

    public function removePage(RemovePageCommand $command): ReplyInterface
    {
        $this->applyAndPublishThat(new PageRemovedEvent($command));
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
