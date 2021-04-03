<?php

declare(strict_types=1);

namespace Era269\Microobject\Tests\Traits;

use Era269\Normalizable\NormalizableInterface;
use Era269\Normalizable\Traits\AbstractNormalizableTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class AbstractNormalizableTraitTest extends TestCase
{
    /** @var NormalizableInterface&MockObject $normalizable */
    private MockObject $normalizable;

    protected function setUp()
    : void
    {
        parent::setUp();

        $this->normalizable = $this->getMockForTrait(AbstractNormalizableTrait::class, [], 'AbstractNormalizableTraitMock');

    }

    /**
     * @dataProvider normalizedDataProvider
     */
    public function testNormalized(array $normalized, array $expected)
    {
        $this->normalizable
            ->method('getNormalized')
            ->willReturn($normalized);

        self::assertEquals($this->normalizable->normalize(), $expected);
    }

    public function normalizedDataProvider(): array
    {
        return [
            'empty' => [
                'normalized' => [],
                'expected' => [
                    '@type' => 'AbstractNormalizableTraitMock',
                ],
            ],
            'with data' => [
                'normalized' => [
                    'field' => 'value',
                ],
                'expected' => [
                    '@type' => 'AbstractNormalizableTraitMock',
                    'field' => 'value',
                ],
            ],
        ];
    }
}

