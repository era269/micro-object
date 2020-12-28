<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line;


use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\AttachWordCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\DetachWordCollectionCommand;
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
    public function attachWord(AttachWordCollectionCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
//    public function applyWordAttachedEvent(WordAttachedCollectionEvent $event): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function detachWord(DetachWordCollectionCommand $command): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
//    public function applyWordDetachedEvent(WordDetachedCollectionEvent $event): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
//    public function applyWordDeletedEvent(WordDeletedEvent $event): ReplyInterface;

    /**
     * @throws ExceptionInterface
     */
    public function processWordMessages(WordMessageInterface $message): ReplyInterface;
}
