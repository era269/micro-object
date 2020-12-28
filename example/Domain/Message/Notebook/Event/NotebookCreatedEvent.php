<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Message\Notebook\Event;


use Era269\Example\Domain\Message\Notebook\AbstractNotebookMessage;
use Era269\Microobject\Message\EventInterface;

final class NotebookCreatedEvent extends AbstractNotebookMessage implements EventInterface
{

}
