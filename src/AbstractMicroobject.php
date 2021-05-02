<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Traits\MicroobjectTrait;
use Era269\Normalizable\Abstraction\AbstractNormalizable;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\SimpleCache\CacheInterface;

abstract class AbstractMicroobject extends AbstractNormalizable implements MicroobjectInterface
{
    use MicroobjectTrait;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->setEventDispatcher($eventDispatcher);
    }
}
