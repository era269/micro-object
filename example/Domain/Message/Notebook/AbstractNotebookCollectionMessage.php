<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook;


use Era269\Microobject\Message\AbstractMessage;

abstract class AbstractNotebookCollectionMessage extends AbstractMessage implements NotebookCollectionMessageInterface
{
}
