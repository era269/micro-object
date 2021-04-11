<?php

declare(strict_types=1);

namespace Era269\Microobject\Tests\Traits;

use Era269\Microobject\Message\EventInterface;
use Era269\Microobject\Traits\CanApplyPrivateEventsTrait;
use LogicException;
use PHPUnit\Framework\TestCase;

class CanApplyPrivateEventsTraitTest extends TestCase
{
    public function testApply(): void
    {
        $this->expectException(LogicException::class);

        $object = new class {
            use CanApplyPrivateEventsTrait;

            public function applyPublic(EventInterface $event): void
            {
                $this->apply($event);
            }
        };
        $object->applyPublic($this->createMock(EventInterface::class));
    }
}
