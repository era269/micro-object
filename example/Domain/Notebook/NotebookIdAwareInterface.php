<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook;


interface NotebookIdAwareInterface
{
    public function getNotebookId(): NotebookId;
}
