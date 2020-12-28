<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook;


use Era269\Example\Domain\BaseIdentifier;
use Era269\Example\Domain\Message\Notebook\Page\Command\AttachPageCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\Command\DetachPageCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\Event\PageAttachedCollectionEvent;
use Era269\Example\Domain\Message\Notebook\Page\Event\PageDetachedCollectionEvent;
use Era269\Example\Domain\Message\Notebook\Page\PageMessageInterface;
use Era269\Example\Domain\Message\Notebook\Page\Query\GetPageQuery;
use Era269\Example\Domain\Message\Notebook\Page\Reply\PageCollectionReply;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Example\Domain\Notebook\Page\PageRepositoryInterface;
use Era269\Microobject\AbstractMicroobjectCollection;
use Era269\Microobject\IdentifierInterface;
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

    public function attachPage(AttachPageCollectionCommand $command): ReplyInterface
    {
        $this->attach(
            $command->getPage()
        );
        $this->processAndSend(
            new PageAttachedCollectionEvent($command)
        );
        return new PositiveReply($command);
    }

    public function applyPageAttachedEvent(PageAttachedCollectionEvent $event): void
    {
        $this->attachIdentifier(
            $event->getPageId()
        );
    }

    public function processPageMessages(PageMessageInterface $message): ReplyInterface
    {
        return $this->processCollectionItemMessage(
            $message,
            $message->getPageId()
        );
    }

    public function applyPageRemovedEvent(PageDetachedCollectionEvent $event): void
    {
        $this->detachIdentifier(
            $event->getPageId()
        );
    }

    public function detachPage(DetachPageCollectionCommand $command): ReplyInterface
    {
        $this->detach(
            $this->getOffset(
                $command->getPageId()
            )
        );
        $this->processAndSend(
            new PageDetachedCollectionEvent($command)
        );
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
