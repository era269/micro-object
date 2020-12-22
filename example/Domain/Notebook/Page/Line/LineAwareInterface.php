<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line;


use Era269\Example\Domain\Notebook\Page\LineInterface;

interface LineAwareInterface
{
    public function getLine():LineInterface;
}
