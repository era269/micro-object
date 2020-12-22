<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event;


use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\AddWordCommand;
use Era269\Example\Domain\Notebook\Page\Line\Traits\WordAwareTrait;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordAwareInterface;
use Era269\Microobject\Message\EventInterface;

final class WordAddedEvent extends AbstractWordCollectionMessage implements EventInterface, WordAwareInterface
{
    use WordAwareTrait;

    public function __construct(AddWordCommand $message)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
            $message->getLineId()
        );
        $this->setWord($message->getWord());
    }
}
