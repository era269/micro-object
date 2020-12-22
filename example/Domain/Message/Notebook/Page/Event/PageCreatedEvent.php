<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Word\Message\Event;


use Era269\Example\Domain\Message\Notebook\Page\AbstractPageMessage;
use Era269\Microobject\Message\EventInterface;

final class PageCreatedEvent extends AbstractPageMessage implements EventInterface
{

}
