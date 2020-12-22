<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line\Traits;


use Era269\Example\Domain\Notebook\Page\Line\WordInterface;

trait WordAwareTrait
{
    private WordInterface $word;

    public function getWord(): WordInterface
    {
        return $this->word;
    }

    private function setWord(WordInterface $word): void
    {
        $this->word = $word;
    }
}
