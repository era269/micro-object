<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain;

use Era269\Microobject\AbstractMicroobject;
use Era269\Microobject\Example\Domain\Message\Notebook\Command\CreateNotebookCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Event\NotebookCreatedEvent;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\PageCollectionMessageInterface;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\PageCollectionInterface;
use Era269\Microobject\Message\Event\EventStreamInterface;
use Era269\Microobject\MessageInterface;
use Era269\Normalizable\Traits\NormalizableTrait;
use Psr\EventDispatcher\EventDispatcherInterface;

final class Notebook extends AbstractMicroobject implements NotebookInterface
{
    use NormalizableTrait;

    private string $name;
    private PageCollectionInterface $pages;
    private NotebookId $id;

    private function __construct(EventDispatcherInterface $eventDispatcher, PageCollectionInterface $pages)
    {
        parent::__construct($eventDispatcher);
        $this->pages = $pages;
    }

    public static function create(
        EventDispatcherInterface $eventDispatcher,
        PageCollectionInterface $pages,
        CreateNotebookCommand $command
    ): self
    {
        $self = new self($eventDispatcher, $pages);
        $self->applyAndPublish(
            new NotebookCreatedEvent($command)
        );

        return $self;
    }

    public static function reconstitute(
        EventDispatcherInterface $eventDispatcher,
        PageCollectionInterface $pages,
        EventStreamInterface $eventStream
    ): self
    {
        $self = new self(
            $eventDispatcher,
            $pages
        );
        $self->apply(...$eventStream);

        return $self;
    }

    /**
     * @inheritDoc
     */
    public function processPageCollectionMessages(PageCollectionMessageInterface $message): MessageInterface
    {
        return $this->pages
            ->process($message);
    }

    /**
     * @inheritDoc
     */
    public function getId(): NotebookId
    {
        return $this->id;
    }

    protected function applyNotebookCreatedEvent(NotebookCreatedEvent $event): void
    {
        $this->id = $event->getNotebookId();
        $this->name = $event->getNotebookName();
    }
}
