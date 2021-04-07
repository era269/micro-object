<?php

declare(strict_types=1);

namespace Era269\Microobject\Tests\Identifier;

use Era269\Microobject\Identifier\BaseIdentifier;
use PHPUnit\Framework\TestCase;

class BaseIdentifierTest extends TestCase
{
    private const ID_VALUE = 'value';

    /**
     * @dataProvider dataProvider
     */
    public function testEqual(string $id1, string $id2, bool $equal): void
    {
        self::assertEquals(
            $equal,
            (new BaseIdentifier($id1))->equals(new BaseIdentifier($id2)),
        );
    }

    public function testNormalize(): void
    {
        self::assertEquals(
            [
                '@type' => BaseIdentifier::class,
                'value' => self::ID_VALUE,
            ],
            (new BaseIdentifier(self::ID_VALUE))->normalize()
        );
    }

    public function testToString(): void
    {
        self::assertEquals(
            self::ID_VALUE,
            (string) new BaseIdentifier(self::ID_VALUE)
        );
    }

    /**
     * @return array<string, array>
     */
    public function dataProvider(): array
    {
        return [
            'equal' => [self::ID_VALUE, self::ID_VALUE, true],
            'not-equal' => [self::ID_VALUE, 'any_other_value', false],
            'equal-empty' => ['', '', true],
        ];
    }
}
