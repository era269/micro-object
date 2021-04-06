<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Traits\CanProcessMessageTrait;

abstract class AbstractMicroobjectCollection implements MicroobjectCollectionInterface
{
    use CanProcessMessageTrait;
}
