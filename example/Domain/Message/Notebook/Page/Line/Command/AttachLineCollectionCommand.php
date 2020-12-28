<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line\Command;

use Era269\Example\Domain\Message\Notebook\Page\Line\AbstractLineCollectionMessage;
use Era269\Example\Domain\Message\Notebook\Page\Line\LineCollectionMessageInterface;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\Line\LineAwareInterface;
use Era269\Example\Domain\Notebook\Page\Line\Traits\LineAwareTrait;
use Era269\Example\Domain\Notebook\Page\LineInterface;
use Era269\Example\Domain\Notebook\Page\PageId;

final class AttachLineCollectionCommand extends AbstractLineCollectionMessage implements LineCollectionMessageInterface, LineAwareInterface
{
    use LineAwareTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId, LineInterface $line)
    {
        parent::__construct($notebookId, $pageId);
        $this->setLine($line);
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'line' => $this->getLine()->normalize()
            ];
    }


}
