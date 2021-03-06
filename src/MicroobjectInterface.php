<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Normalizable\NormalizableInterface;

interface MicroobjectInterface extends
    NormalizableInterface,
    MessageProcessorInterface,
    IdentifiableInterface
{

}
