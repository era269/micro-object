<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line\Word;


use Era269\Example\Domain\Notebook\Page\Line\WordInterface;

interface WordAwareInterface
{
    public function getWord(): WordInterface;
}
