<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line;


use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\AddWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\RemoveWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordAddedEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Event\WordRemovedEvent;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Query\GetWordQuery;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\WordMessageInterface;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\IdentifierCollectionAwareInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\MicroobjectCollectionInterface;

interface WordCollectionInterface extends MicroobjectCollectionInterface, IdentifierCollectionAwareInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function getWord(GetWordQuery $query): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function addWord(AddWordCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function applyWordAddedEvent(WordAddedEvent $event): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function removeWord(RemoveWordCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function applyWordRemovedEvent(WordRemovedEvent $event): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function processWordMessages(WordMessageInterface $message): ReplyInterface;
}
