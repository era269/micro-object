<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\Example\Domain\NotebookInterface;

interface NotebookAwareInterface
{
    public function getNotebook(): NotebookInterface;
}
