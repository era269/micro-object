<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Event;


use Era269\Example\Domain\Message\Notebook\AbstractNotebookCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Command\DetachNotebookCollectionCommand;
use Era269\Example\Domain\Notebook\NotebookIdAwareInterface;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\EventInterface;

final class NotebookDetachedCollectionEvent extends AbstractNotebookCollectionMessage implements EventInterface, NotebookIdAwareInterface
{
    use NotebookIdAwareTrait;

    public function __construct(DetachNotebookCollectionCommand $command)
    {
        parent::__construct();
        $this->setNotebookId(
            $command->getNotebookId()
        );
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'notebookId' => $this->getNotebookId()->normalize(),
            ];
    }
}
