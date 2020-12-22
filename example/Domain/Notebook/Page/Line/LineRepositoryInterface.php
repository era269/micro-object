<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line;


use Era269\Example\Domain\Notebook\Page\LineInterface;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\RepositoryInterface;

interface LineRepositoryInterface extends RepositoryInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function get(IdentifierInterface $id): LineInterface;

    /**
     * @throws ExceptionInterface
     */
    public function attachLine(LineInterface $line): void;
}
