<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Page\Query;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\AbstractPageMessage;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Normalizable\DenormalizableInterface;

final class GetTextQuery extends AbstractPageMessage implements DenormalizableInterface
{
    public static function denormalize(array $data): static
    {
        return new self(
            NotebookId::create($data['notebookId']),
            PageId::create($data['pageId']),
        );
    }
}
