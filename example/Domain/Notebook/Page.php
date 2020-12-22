<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook;


use Era269\Example\Domain\Message\Notebook\Page\Line\LineCollectionMessageInterface;
use Era269\Example\Domain\Notebook\Page\LineCollectionInterface;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\AbstractMicroobject;
use Era269\Microobject\Message\ReplyInterface;

final class Page extends AbstractMicroobject implements PageInterface
{
    use NotebookIdAwareTrait;

    private PageId $id;
    private LineCollectionInterface $lines;

    public function __construct(NotebookId $notebookId, PageId $id, LineCollectionInterface $lines)
    {
        parent::__construct($lines);
        $this->id = $id;
        $this->lines = $lines;
        $this->setNotebookId($notebookId);
    }

    public function processLineCollectionMessages(LineCollectionMessageInterface $message): ReplyInterface
    {
        return $this->lines
            ->process($message);
    }

    /**
     * @inheritDoc
     */
    protected function getNormalized(): array
    {
        return [
            'id' => $this->getId()->normalize(),
            'notebookId' => $this->getNotebookId()->normalize(),
            'lines' => $this->lines->normalize(),
        ];
    }

    public function getId(): PageId
    {
        return $this->id;
    }
}
