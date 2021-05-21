<?php

declare(strict_types=1);

namespace Era269\Microobject\Traits;

use Era269\Microobject\IdentifierInterface;
use Era269\Normalizable\Traits\SimpleNormalizableTrait;

trait MessageTrait
{
    use SimpleNormalizableTrait;

    protected IdentifierInterface $id;

    public function getId(): IdentifierInterface
    {
        return $this->id;
    }

    final protected function setId(IdentifierInterface $id): void
    {
        $this->id = $id;
    }
}
