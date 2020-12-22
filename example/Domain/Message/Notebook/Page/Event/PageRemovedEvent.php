<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Word\Message\Event;


use Era269\Example\Domain\Message\Notebook\Page\AbstractPageMessage;
use Era269\Example\Domain\Message\Notebook\Page\Command\RemovePageCommand;
use Era269\Microobject\Message\EventInterface;

final class PageRemovedEvent extends AbstractPageMessage implements EventInterface
{
    public function __construct(RemovePageCommand $message)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
        );
    }
}
