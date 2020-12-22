<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Page\Command;


use Era269\Example\Domain\Message\Notebook\Page\PageCollectionMessageInterface;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\PageAwareInterface;
use Era269\Example\Domain\Notebook\Page\Traits\PageAwareTrait;
use Era269\Example\Domain\Notebook\PageInterface;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\AbstractMessage;

final class AddPageCommand extends AbstractMessage implements PageCollectionMessageInterface, PageAwareInterface
{
    use PageAwareTrait;
    use NotebookIdAwareTrait;

    public function __construct(NotebookId $notebookId, PageInterface $page)
    {
        parent::__construct();
        $this->setPage($page);
        $this->setNotebookId($notebookId);
    }
}
