<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Notebook\Page\Line\Word;

interface WordIdAwareInterface
{
    public function getWordId(): WordId;
}
