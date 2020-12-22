<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Reply;

use Era269\Example\Domain\Message\Notebook\Page\PageCollectionMessageInterface;
use Era269\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Microobject\Message\Reply\BaseReply;
use Era269\Microobject\NormalizableInterface;

final class PageCollectionReply extends BaseReply implements PageCollectionMessageInterface
{
    use NotebookIdAwareTrait;

    public function __construct(PageCollectionMessageInterface $message, NormalizableInterface $payload)
    {
        parent::__construct($message, $payload);
        $this->setNotebookId($message->getNotebookId());
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'notebookId' => $this->getNotebookId()->normalize(),
            ];
    }
}
