<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line\Traits;


use Era269\Example\Domain\Notebook\Page\LineInterface;

trait LineAwareTrait
{
    private LineInterface $line;

    public function getLine(): LineInterface
    {
        return $this->line;
    }

    private function setLine(LineInterface $line): void
    {
        $this->line = $line;
    }
}
