<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook;


use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;

abstract class AbstractNotebookMessage extends AbstractNotebookCollectionMessage implements NotebookMessageInterface
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
                'notebookId' => $this->getNotebookId()->normalize(),
            ];
    }
}
