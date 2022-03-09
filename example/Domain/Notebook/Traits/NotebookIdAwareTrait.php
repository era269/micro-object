<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook\Traits;

use Era269\Microobject\Example\Domain\Notebook\NotebookId;

trait NotebookIdAwareTrait
{
    private NotebookId $notebookId;

    public function getNotebookId(): NotebookId
    {
        return $this->notebookId;
    }

    private function setNotebookId(NotebookId $notebookId): void
    {
        $this->notebookId = $notebookId;
    }
}
