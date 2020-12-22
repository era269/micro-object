<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line\Reply;

use Era269\Example\Domain\Message\Notebook\Page\Line\LineCollectionMessageInterface;
use Era269\Example\Domain\Notebook\Page\Traits\PageIdAwareTrait;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\Reply\BaseReply;
use Era269\Microobject\NormalizableInterface;

final class LineCollectionReply extends BaseReply implements LineCollectionMessageInterface
{
    use NotebookIdAwareTrait;
    use PageIdAwareTrait;

    public function __construct(LineCollectionMessageInterface $message, NormalizableInterface $payload)
    {
        parent::__construct($message, $payload);
        $this->setNotebookId($message->getNotebookId());
        $this->setPageId($message->getPageId());
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'notebookId' => $this->getNotebookId()->normalize(),
                'pageId' => $this->getPageId()->normalize(),
            ];
    }
}
