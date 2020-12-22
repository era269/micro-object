<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Notebook\Page\Line;

use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\RevertWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordCreatedEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordUpdatedEvent;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Microobject\DenormalizableInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\MicroobjectInterface;

interface WordInterface extends MicroobjectInterface, DenormalizableInterface
{
    public function getId(): WordId;

    public function applyWordCreatedEvent(WordCreatedEvent $event): ReplyInterface;

    public function applyWordUpdatedEvent(WordUpdatedEvent $event): ReplyInterface;

    public function revert(RevertWordCommand $command): ReplyInterface;
}
