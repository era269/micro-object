<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Command;

use Era269\Microobject\Example\Domain\Message\Notebook\AbstractNotebookCollectionMessage;
use Era269\Microobject\Example\Domain\Notebook\NotebookId;
use Era269\Microobject\Example\Domain\Notebook\NotebookIdAwareInterface;
use Era269\Microobject\Example\Domain\Notebook\Traits\NotebookIdAwareTrait;
use Era269\Normalizable\DenormalizableInterface;
use Era269\Normalizable\Traits\NormalizableTrait;

final class CreateNotebookCommand extends AbstractNotebookCollectionMessage implements NotebookIdAwareInterface, DenormalizableInterface
{
    use NotebookIdAwareTrait;
    use NormalizableTrait;

    public function __construct(
        NotebookId $notebookId,
        private string $notebookName
    )
    {
        parent::__construct();
        $this->setNotebookId($notebookId);
    }

    /**
     * @inheritDoc
     */
    public static function denormalize(array $data): static
    {
        return new self(
            new NotebookId($data['notebookId']),
            $data['notebookName']
        );
    }

    public function getNotebookName(): string
    {
        return $this->notebookName;
    }
}
