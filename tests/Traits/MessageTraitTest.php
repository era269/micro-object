<?php

declare(strict_types=1);

namespace Era269\Microobject\Tests\Traits;

use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Traits\MessageTrait;
use PHPUnit\Framework\TestCase;

class MessageTraitTest extends TestCase
{
    public function test()
    {
        $id = $this->createMock(IdentifierInterface::class);
        $normalizedId = [
            '@type' => $id::class,
            'value' => 1,
        ];
        $id
            ->method('normalize')
            ->willReturn($normalizedId);
        $message = new class($id) {
            use MessageTrait;
            public function __construct(IdentifierInterface $id)
            {
                $this->setId($id);
            }
        };

        self::assertSame(
            $id,
            $message->getId()
        );
    }
}
