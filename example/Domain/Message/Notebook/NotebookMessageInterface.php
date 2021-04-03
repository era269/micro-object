<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook;

use Era269\Microobject\Example\Domain\Notebook\NotebookIdAwareInterface;

interface NotebookMessageInterface extends NotebookCollectionMessageInterface, NotebookIdAwareInterface
{

}
