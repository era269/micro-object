<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Countable;

interface CountableInterface extends Countable
{
    public function count(): int;
}
