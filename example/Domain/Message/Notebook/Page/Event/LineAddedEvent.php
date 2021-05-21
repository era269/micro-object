<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Page\Event;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\AbstractPageMessage;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\AddLineCommand;
use Era269\Microobject\Example\Domain\Message\Traits\OccurredAtAwareTrait;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\EventInterface;

final class LineAddedEvent extends AbstractPageMessage implements EventInterface
{
    use OccurredAtAwareTrait;

    protected string $line;

    public function __construct(AddLineCommand $command)
    {
        parent::__construct(
            $command->getNotebookId(),
            $command->getPageId()
        );
        $this->line = $command->getLine();
        $this->setOccurredAt();
    }

    public function getDomainModelId(): IdentifierInterface
    {
        return $this->getPageId();
    }

    public function getLine(): string
    {
        return $this->line;
    }
}
