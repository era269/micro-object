<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Traits\MicroobjectTrait;
use Era269\Normalizable\AbstractNormalizableObject;
use Psr\EventDispatcher\EventDispatcherInterface;

abstract class AbstractMicroobject extends AbstractNormalizableObject implements MicroobjectInterface
{
    use MicroobjectTrait;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->setEventDispatcher($eventDispatcher);
    }
}
