<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line\Word;


use Era269\Example\Domain\Notebook\Page\Line\WordInterface;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\RepositoryInterface;

interface WordRepositoryInterface extends RepositoryInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function get(IdentifierInterface $id): WordInterface;

    /**
     * @throws ExceptionInterface
     */
    public function attachWord(WordInterface $word): void;
}
