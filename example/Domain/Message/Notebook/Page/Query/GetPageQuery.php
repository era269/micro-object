<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Page\Query;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\AbstractPageCollectionMessage;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Page\PageIdAwareInterface;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Normalizable\DenormalizableInterface;

final class GetPageQuery extends AbstractPageCollectionMessage implements PageIdAwareInterface, DenormalizableInterface
{
    use PageIdAwareTrait;

    public function __construct(NotebookId $notebookId, PageId $pageId)
    {
        parent::__construct($notebookId);
        $this->setPageId($pageId);
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'pageId' => $this->getPageId()->normalize()
            ];
    }

    public static function denormalize(array $data): static
    {
        return new self(
            new NotebookId($data['notebookId']),
            new PageId($data['pageId']),
        );
    }
}
