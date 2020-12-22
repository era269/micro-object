<?php
declare(strict_types=1);


namespace Era269\Example\Domain\Notebook\Page\Line;


interface LineIdAwareInterface
{
    public function getLineId(): LineId;
}
