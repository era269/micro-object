<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain\Message\Notebook\Page\Command;


use Era269\Microobject\Example\Domain\Message\Notebook\Page\AbstractPageMessage;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\Page\PageId;
use Era269\Microobject\Example\Domain\Notebook\Page\Text;
use Era269\Normalizable\DenormalizableInterface;

final class CreatePageCommand extends AbstractPageMessage implements DenormalizableInterface
{
    public function __construct(
        NotebookId $notebookId,
        PageId $pageId,
        private Text $text,
    )
    {
        parent::__construct($notebookId, $pageId);
    }

    public static function denormalize(array $data): static
    {
        return new self(
            NotebookId::create($data['notebookId']),
            PageId::create($data['pageId']),
            new Text(...$data['text'])
        );
    }

    public function getText(): Text
    {
        return $this->text;
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'text' => $this->text->normalize(),
            ];
    }


}
