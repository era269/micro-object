<?php

declare(strict_types=1);

namespace Era269\Microobject\Tests\Traits;

use Era269\Microobject\Traits\NormalizableExceptionTrait;
use Era269\Normalizable\NormalizableInterface;
use Exception;
use PHPUnit\Framework\TestCase;

class NormalizableExceptionTraitTest extends TestCase
{
    private NormalizableInterface $exception;

    public function testNormalize()
    {
        self::assertEquals(
            $this->exception::class,
            $this->exception->getType()
        );
        self::assertEquals(
            $this->exception::class,
            $this->exception->normalize()['@type']
        );
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->exception = new class extends Exception implements NormalizableInterface {
            use NormalizableExceptionTrait;
        };
    }
}
