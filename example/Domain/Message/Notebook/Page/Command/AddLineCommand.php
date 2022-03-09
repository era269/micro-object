<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Page\Command;

use Era269\Microobject\Example\Domain\Message\CommandInterface;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\AbstractPageMessage;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Normalizable\DenormalizableInterface;
use Era269\Normalizable\Traits\NormalizableTrait;

final class AddLineCommand extends AbstractPageMessage implements CommandInterface, DenormalizableInterface
{
    use NormalizableTrait;

    public function __construct(
        NotebookId $notebookId,
        PageId $pageId,
        private string $line,
    )
    {
        parent::__construct($notebookId, $pageId);
    }

    /**
     * @inheritDoc
     */
    public static function denormalize(array $data): static
    {
        return new self(
            new NotebookId($data['notebookId']),
            new PageId($data['pageId']),
            $data['line'],
        );
    }

    public function getLine(): string
    {
        return $this->line;
    }
}
