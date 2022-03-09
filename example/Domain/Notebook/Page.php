<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\AbstractMicroobject;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\AddLineCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\CreatePageCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Event\LineAddedEvent;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Event\PageCreatedEvent;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Query\GetTextQuery;
use Era269\Microobject\Example\Domain\Message\Response\BaseResponse;
use Era269\Microobject\Example\Domain\Message\ResponseInterface;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\Example\Domain\Notebook\Page\Text;
use Era269\Microobject\Message\Event\EventStreamInterface;
use Era269\Microobject\Message\EventInterface;
use Era269\Normalizable\Traits\NormalizableTrait;
use Psr\EventDispatcher\EventDispatcherInterface;

final class Page extends AbstractMicroobject implements PageInterface
{
    use NormalizableTrait;

    private PageId $id;
    private Text $text;

    private function __construct(
        EventDispatcherInterface $eventDispatcher,
    )
    {
        parent::__construct($eventDispatcher);
    }

    public static function create(
        EventDispatcherInterface $eventDispatcher,
        CreatePageCommand $command
    ): self
    {
        $self = new self($eventDispatcher);
        $self->applyAndPublish(
            new PageCreatedEvent(
                $command
            )
        );

        return $self;
    }

    public static function reconstitute(
        EventDispatcherInterface $eventDispatcher,
        EventStreamInterface $eventStream,
    ): self
    {
        $self = new self($eventDispatcher);
        foreach ($eventStream as $event) {
            $self->apply($event);
        }

        return $self;
    }

    /**
     * @inheritDoc
     */
    public function addLine(AddLineCommand $command): EventInterface
    {
        $event = new LineAddedEvent($command);
        $this->applyAndPublish(
            $event
        );

        return $event;
    }

    /**
     * @inheritDoc
     */
    public function getText(GetTextQuery $query): ResponseInterface
    {
        return new BaseResponse($this->text);
    }

    protected function applyLineAddedEvent(LineAddedEvent $event): void
    {
        $this->text = $this->text->withLine(
            $event->getLine()
        );
    }

    protected function applyPageCreatedEvent(PageCreatedEvent $event): void
    {
        $this->id = $event->getPageId();
        $this->text = $event->getText();
    }

    public function getId(): PageId
    {
        return $this->id;
    }
}
