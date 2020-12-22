<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Notebook\Page\Line\Traits;

use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;

trait WordIdAwareTrait
{
    private WordId $wordId;

    public function getWordId(): WordId
    {
        return $this->wordId;
    }

    private function setWordId(WordId $wordId): void
    {
        $this->wordId = $wordId;
    }
}
