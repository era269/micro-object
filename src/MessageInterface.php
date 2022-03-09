<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Example\Domain\NormalizableInterface;

interface MessageInterface extends
    NormalizableInterface,
    IdentifiableInterface,
    \Era269\MessageProcessor\MessageInterface
{

}
