<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line\Word\Message\Event;


use Era269\Example\Domain\Message\Notebook\Page\Line\AbstractLineMessage;
use Era269\Example\Domain\Message\Notebook\Page\Line\Command\RemoveLineCommand;
use Era269\Microobject\Message\EventInterface;

final class LineRemovedEvent extends AbstractLineMessage implements EventInterface
{
    public function __construct(RemoveLineCommand $message)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
            $message->getLineId(),
        );
    }
}
