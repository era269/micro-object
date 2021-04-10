<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain\Message\Notebook\Page\Event;


use DateTimeInterface;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\AbstractPageMessage;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\AddLineCommand;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\EventInterface;

final class LineAddedEvent extends AbstractPageMessage implements EventInterface
{
    private string $line;

    public function __construct(AddLineCommand $command)
    {
        parent::__construct(
            $command->getNotebookId(),
            $command->getPageId()
        );
        $this->line = $command->getLine();
    }

    public function getDomainModelId(): IdentifierInterface
    {
        return $this->getPageId();
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

    public function getLine(): string
    {
        return $this->line;
    }
}
