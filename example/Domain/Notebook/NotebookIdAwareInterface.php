<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain\Notebook;


interface NotebookIdAwareInterface
{
    public function getNotebookId(): NotebookId;
}
