<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Event;

use DateTimeInterface;
use Era269\Microobject\Example\Domain\Message\Notebook\AbstractNotebookMessage;
use Era269\Microobject\Example\Domain\Message\Notebook\Command\CreateNotebookCommand;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\EventInterface;

final class NotebookCreatedEvent extends AbstractNotebookMessage implements EventInterface
{
    private string $notebookName;

    public function __construct(CreateNotebookCommand $command)
    {
        parent::__construct($command->getNotebookId());
        $this->notebookName = $command->getNotebookName();
    }

    public function getDomainModelId(): IdentifierInterface
    {
        return $this->getNotebookId();
    }

    public function getNotebookName(): string
    {
        return $this->notebookName;
    }

    public function getOccurredAt(): DateTimeInterface
    {
        return $this->getCreatedAt();
    }

    /**
     * @inheritDoc
     */
    protected function getNormalized(): array
    {
        return parent::getNormalized() + $this->getSelfNormalized();
    }
}
