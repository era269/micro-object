<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Command;


use Era269\Example\Domain\Message\Notebook\AbstractNotebookCollectionMessage;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\NotebookIdAwareInterface;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;

final class DetachNotebookCollectionCommand extends AbstractNotebookCollectionMessage implements NotebookIdAwareInterface
{
    use NotebookIdAwareTrait;

    public function __construct(NotebookId $notebookId)
    {
        parent::__construct();
        $this->setNotebookId($notebookId);
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'notebookId' => $this->getNotebookId()->normalize()
            ];
    }
}
