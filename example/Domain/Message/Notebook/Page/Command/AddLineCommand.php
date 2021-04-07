<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Page\Command;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\AbstractPageMessage;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\Message\Request\CommandInterface;
use Era269\Normalizable\DenormalizableInterface;

final class AddLineCommand extends AbstractPageMessage implements CommandInterface, DenormalizableInterface
{
    public function __construct(
        NotebookId $notebookId,
        PageId $pageId,
        private string $line,
    )
    {
        parent::__construct($notebookId, $pageId);
    }

    public function getLine(): string
    {
        return $this->line;
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'line' => $this->line
            ];
    }

    public static function denormalize(array $data): static
    {
        return new self(
            new NotebookId($data['notebookId']),
            new PageId($data['pageId']),
            $data['line'],
        );
    }
}
