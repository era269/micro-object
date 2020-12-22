<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Query;

use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordMessage;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Example\Domain\Notebook\Page\PageId;

final class GetWordQuery extends AbstractWordMessage
{
    public static function denormalize(array $normalized): self
    {
        return new self(
            NotebookId::denormalize($normalized['notebookId']),
            PageId::denormalize($normalized['pageId']),
            LineId::denormalize($normalized['lineId']),
            WordId::denormalize($normalized['word']['id']),
        );
    }
}
