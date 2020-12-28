<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event;


use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordMessage;
use Era269\Microobject\Message\EventInterface;

final class WordDeletedEvent extends AbstractWordMessage implements EventInterface
{
    public function __construct(AbstractWordMessage $message)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
            $message->getLineId(),
            $message->getWordId()
        );
    }
}
