<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Event;


use Era269\Example\Domain\Message\Notebook\Page\AbstractPageCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Page\Command\AddPageCommand;
use Era269\Example\Domain\Notebook\Page\PageAwareInterface;
use Era269\Example\Domain\Notebook\Page\Traits\PageAwareTrait;
use Era269\Microobject\Message\EventInterface;

final class PageAddedEvent extends AbstractPageCollectionMessage implements EventInterface, PageAwareInterface
{
    use PageAwareTrait;

    public function __construct(AddPageCommand $message)
    {
        parent::__construct(
            $message->getNotebookId(),
        );
        $this->setPage($message->getPage());
    }
}
