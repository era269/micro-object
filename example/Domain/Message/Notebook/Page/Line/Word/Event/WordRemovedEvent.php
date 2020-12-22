<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event;


use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordMessage;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\RemoveWordCommand;
use Era269\Microobject\Message\EventInterface;

final class WordRemovedEvent extends AbstractWordMessage implements EventInterface
{
    public function __construct(RemoveWordCommand $message)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
            $message->getLineId(),
            $message->getWordId()
        );
    }
}
