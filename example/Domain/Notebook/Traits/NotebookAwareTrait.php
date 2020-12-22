<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Traits;


use Era269\Example\Domain\NotebookInterface;

trait NotebookAwareTrait
{
    private NotebookInterface $notebook;

    public function getNotebook(): NotebookInterface
    {
        return $this->notebook;
    }

    private function setNotebook(NotebookInterface $notebook): void
    {
        $this->notebook = $notebook;
    }
}
