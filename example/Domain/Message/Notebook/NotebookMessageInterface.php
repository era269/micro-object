<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook;

use Era269\Example\Domain\Notebook\NotebookIdAwareInterface;

interface NotebookMessageInterface extends NotebookCollectionMessageInterface, NotebookIdAwareInterface
{

}
