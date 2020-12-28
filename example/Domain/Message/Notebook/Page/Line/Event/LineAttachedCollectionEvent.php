<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line\Event;


use Era269\Example\Domain\Message\Notebook\Page\Line\AbstractLineCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Page\Line\Command\AttachLineCollectionCommand;
use Era269\Example\Domain\Notebook\Page\Line\LineIdAwareInterface;
use Era269\Example\Domain\Notebook\Page\Line\Traits\LineIdAwareTrait;
use Era269\Microobject\Message\EventInterface;

final class LineAttachedCollectionEvent extends AbstractLineCollectionMessage implements EventInterface, LineIdAwareInterface
{
    use LineIdAwareTrait;

    public function __construct(AttachLineCollectionCommand $message)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
        );
        $this->setLineId(
            $message->getLine()->getId()
        );
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'lineId' => $this->getLineId()->normalize()
            ];
    }


}
