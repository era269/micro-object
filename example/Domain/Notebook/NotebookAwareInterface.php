<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook;


use Era269\Example\Domain\NotebookInterface;
use Era269\Microobject\Exception\ExceptionInterface;

interface NotebookAwareInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function getNotebook(): NotebookInterface;
}
