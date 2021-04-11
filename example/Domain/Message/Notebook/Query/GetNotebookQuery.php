<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Query;

use Era269\Microobject\Example\Domain\Message\Notebook\AbstractNotebookCollectionMessage;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\NotebookIdAwareInterface;
use Era269\Microobject\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Normalizable\DenormalizableInterface;

final class GetNotebookQuery extends AbstractNotebookCollectionMessage implements NotebookIdAwareInterface, DenormalizableInterface
{
    use NotebookIdAwareTrait;

    public function __construct(NotebookId $notebookId)
    {
        parent::__construct();
        $this->setNotebookId($notebookId);
    }

    public static function denormalize(array $data): static
    {
        return new self(
            new NotebookId($data['notebookId']),
        );
    }

    /**
     * @inheritDoc
     */
    protected function getNormalized(): array
    {
        return parent::getNormalized() + $this->getSelfNormalized();
    }
}
