<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Notebook\Page\Line\Traits;

use Era269\Example\Domain\Notebook\Page\Line\LineId;

trait LineIdAwareTrait
{
    private LineId $lineId;

    public function getLineId(): LineId
    {
        return $this->lineId;
    }

    private function setLineId(LineId $lineId): void
    {
        $this->lineId = $lineId;
    }
}
