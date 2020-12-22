<?php
declare(strict_types=1);


namespace Era269\Example\Domain;


use Era269\Example\Domain\Message\Notebook\NotebookMessageInterface;
use Era269\Example\Domain\Message\Notebook\Page\PageCollectionMessageInterface;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\PageCollectionInterface;
use Era269\Microobject\AbstractMicroobject;
use Era269\Microobject\Message\ReplyInterface;

final class Notebook extends AbstractMicroobject implements NotebookInterface
{
    private string $name;
    private PageCollectionInterface $pages;
    private NotebookId $id;

    public function __construct(NotebookId $id, string $name, PageCollectionInterface $pages)
    {
        parent::__construct($pages);
        $this->id = $id;
        $this->name = $name;
        $this->pages = $pages;
    }

    public function getId(): NotebookId
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function processPageCollectionMessages(PageCollectionMessageInterface $message): ReplyInterface
    {
        return $this->pages
            ->process($message);
    }

    /**
     * @inheritDoc
     */
    public function processOwnMessages(NotebookMessageInterface $message): ReplyInterface
    {
        return $this->process($message);
    }

    protected function getNormalized(): array
    {
        return [
            'id' => $this->getId()->normalize(),
            'name' => $this->name,
            'pages' => $this->pages->normalize(),
        ];
    }
}
