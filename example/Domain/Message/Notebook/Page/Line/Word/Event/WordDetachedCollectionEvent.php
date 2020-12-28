<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event;


use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\DetachWordCollectionCommand;
use Era269\Example\Domain\Notebook\Page\Line\Traits\WordIdAwareTrait;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordIdAwareInterface;
use Era269\Microobject\Message\EventInterface;

final class WordDetachedCollectionEvent extends AbstractWordCollectionMessage implements EventInterface, WordIdAwareInterface
{
    use WordIdAwareTrait;

    public function __construct(DetachWordCollectionCommand $message)
    {
        parent::__construct(
            $message->getNotebookId(),
            $message->getPageId(),
            $message->getLineId()
        );
        $this->setWordId($message->getWordId());
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'wordId' => $this->getWordId()->normalize()
            ];
    }
}
