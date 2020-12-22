<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command;

use Era269\Example\Domain\Message\Notebook\Page\Line\Word\AbstractWordMessage;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\DenormalizableInterface;

final class RemoveWordCommand extends AbstractWordMessage implements DenormalizableInterface
{
    public static function denormalize(array $data): self
    {
        return new self(
            NotebookId::denormalize($data['notebookId']),
            PageId::denormalize($data['pageId']),
            LineId::denormalize($data['lineId']),
            WordId::denormalize($data['wordId']),
        );
    }
}
