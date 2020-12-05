<?php

declare(strict_types=1);

namespace Era269\TrueObject;

use Countable;

interface CountableInterface extends Countable
{
    public function count(): int;
}
