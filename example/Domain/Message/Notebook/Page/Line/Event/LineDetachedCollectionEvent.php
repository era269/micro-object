<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line\Word\Message\Event;


use Era269\Example\Domain\Message\Notebook\Page\Line\AbstractLineCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Page\Line\Command\DetachLineCollectionCommand;
use Era269\Example\Domain\Notebook\Page\Line\LineIdAwareInterface;
use Era269\Example\Domain\Notebook\Page\Line\Traits\LineIdAwareTrait;
use Era269\Microobject\Message\EventInterface;

final class LineDetachedCollectionEvent extends AbstractLineCollectionMessage implements EventInterface, LineIdAwareInterface
{
    use LineIdAwareTrait;

    public function __construct(DetachLineCollectionCommand $message)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
        );
        $this->setLineId(
            $message->getLineId()
        );
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'lineId' => $this->getLineId()->normalize(),
            ];
    }


}
