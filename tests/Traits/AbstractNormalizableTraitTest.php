<?php

declare(strict_types=1);

namespace Era269\Microobject\Tests\Traits;

use Era269\Normalizable\NormalizableInterface;
use Era269\Normalizable\Traits\AbstractNormalizableTrait;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class AbstractNormalizableTraitTest extends TestCase
{
    private MockObject|NormalizableInterface $normalizable;

    /**
     * @dataProvider normalizedDataProvider
     *
     * @param array<string, string> $normalized
     * @param array<string, string> $expected
     */
    public function testNormalized(array $normalized, array $expected): void
    {
        $this->normalizable
            ->method('getNormalized')
            ->willReturn($normalized);

        self::assertEquals($this->normalizable->normalize(), $expected);
    }

    /**
     * @return array<string, mixed>
     */
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

    protected function setUp(): void
    {
        parent::setUp();

        $this->normalizable = $this->getMockForTrait(
            AbstractNormalizableTrait::class,
            [],
            'AbstractNormalizableTraitMock'
        );
    }
}

