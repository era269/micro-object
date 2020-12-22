<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line\Event;


use Era269\Example\Domain\Message\Notebook\Page\Line\AbstractLineCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Page\Line\Command\AddLineCommand;
use Era269\Example\Domain\Notebook\Page\Line\LineAwareInterface;
use Era269\Example\Domain\Notebook\Page\Line\Traits\LineAwareTrait;
use Era269\Microobject\Message\EventInterface;

final class LineAddedEvent extends AbstractLineCollectionMessage implements EventInterface, LineAwareInterface
{
    use LineAwareTrait;

    public function __construct(AddLineCommand $message)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
        );
        $this->setLine($message->getLine());
    }
}
