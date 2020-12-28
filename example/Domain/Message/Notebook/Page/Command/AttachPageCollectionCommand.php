<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Command;


use Era269\Example\Domain\Message\Notebook\Page\AbstractPageCollectionMessage;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\PageAwareInterface;
use Era269\Example\Domain\Notebook\Page\Traits\PageAwareTrait;
use Era269\Example\Domain\Notebook\PageInterface;

final class AttachPageCollectionCommand extends AbstractPageCollectionMessage implements PageAwareInterface
{
    use PageAwareTrait;

    public function __construct(NotebookId $notebookId, PageInterface $page)
    {
        parent::__construct($notebookId);
        $this->setPage($page);
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'page' => $this->getPage()->normalize()
            ];
    }
}
