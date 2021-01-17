<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line;


use Era269\Example\Domain\Notebook\Page\LineInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\RepositoryInterface;

interface LineRepositoryInterface extends RepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function get(IdentifierInterface $id): LineInterface;

    public function attachLine(LineInterface $line): void;
}
