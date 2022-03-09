<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Page\Command;

use Era269\Microobject\Example\Domain\Message\Notebook\Page\AbstractPageCollectionMessage;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\Example\Domain\Notebook\Page\Text;
use Era269\Microobject\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Normalizable\DenormalizableInterface;
use Era269\Normalizable\Traits\NormalizableTrait;

final class CreatePageCommand extends AbstractPageCollectionMessage implements DenormalizableInterface
{
    use PageIdAwareTrait;
    use NormalizableTrait;

    public function __construct(
        NotebookId $notebookId,
        PageId $pageId,
        private Text $text,
    )
    {
        parent::__construct($notebookId);
        $this->setPageId($pageId);
    }

    /**
     * @inheritDoc
     */
    public static function denormalize(array $data): static
    {
        return new self(
            new NotebookId($data['notebookId']),
            new PageId($data['pageId']),
            new Text(...$data['text'])
        );
    }

    public function getText(): Text
    {
        return $this->text;
    }
}
