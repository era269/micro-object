<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain\Message\Notebook\Page;


use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\AbstractMessage;

abstract class AbstractPageCollectionMessage extends AbstractMessage implements PageCollectionMessageInterface
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
