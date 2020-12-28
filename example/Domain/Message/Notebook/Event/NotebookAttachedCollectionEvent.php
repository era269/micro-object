<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Event;


use Era269\Example\Domain\Message\Notebook\AbstractNotebookCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Command\AttachNotebookCollectionCommand;
use Era269\Example\Domain\Notebook\NotebookIdAwareInterface;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\EventInterface;

final class NotebookAttachedCollectionEvent extends AbstractNotebookCollectionMessage implements EventInterface, NotebookIdAwareInterface
{
    use NotebookIdAwareTrait;

    public function __construct(AttachNotebookCollectionCommand $command)
    {
        parent::__construct();
        $this->setNotebookId(
            $command->getNotebook()->getId()
        );
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'notebookId' => $this->getNotebookId()->normalize(),
            ];
    }
}
