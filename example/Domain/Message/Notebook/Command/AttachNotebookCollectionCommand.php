<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Command;


use Era269\Example\Domain\Message\Notebook\AbstractNotebookCollectionMessage;
use Era269\Example\Domain\Notebook\NotebookAwareInterface;
use Era269\Example\Domain\Notebook\Traits\NotebookAwareTrait;
use Era269\Example\Domain\NotebookInterface;

final class AttachNotebookCollectionCommand extends AbstractNotebookCollectionMessage implements NotebookAwareInterface
{
    use NotebookAwareTrait;

    public function __construct(NotebookInterface $notebook)
    {
        parent::__construct();
        $this->setNotebook($notebook);
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'notebook' => $this->getNotebook()->normalize(),
            ];
    }


}
