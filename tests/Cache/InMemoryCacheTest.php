<?php

declare(strict_types=1);

namespace Era269\Microobject\Tests\Cache;

use Era269\Microobject\Cache\InMemoryCache;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;
use Era269\Microobject\Cache\InvalidArgumentException;

class InMemoryCacheTest extends TestCase
{
    private const INVALID_KEY      = 'invalid/key';
    private const INVALID_MULTIPLE = [self::INVALID_KEY, 'value'];
    private const NOT_ITERABLE     = 0;

    /**
     * @throws InvalidArgumentException
     */
    public function testSet(): CacheInterface
    {
        $cache = new InMemoryCache();
        self::assertTrue(
            $cache->set('a', 0)
        );

        return $cache;
    }

    /**
     * @depends testSet
     * @throws InvalidArgumentException
     */
    public function testGet(CacheInterface $cache): CacheInterface
    {
        self::assertEquals(0, $cache->get('a'));

        return $cache;
    }

    /**
     * @depends testGet
     * @throws InvalidArgumentException
     */
    public function testHas(CacheInterface $cache): CacheInterface
    {
        self::assertTrue($cache->has('a'));
        self::assertFalse($cache->has('z'));

        return $cache;
    }

    /**
     * @depends testHas
     * @throws InvalidArgumentException
     */
    public function testDelete(CacheInterface $cache): CacheInterface
    {
        self::assertTrue(
            $cache->delete('a')
        );
        self::assertFalse($cache->has('a'));
        self::assertFalse(
            $cache->delete('a')
        );

        return $cache;
    }

    /**
     * @depends testDelete
     * @throws InvalidArgumentException
     */
    public function testSetMultiple(CacheInterface $cache): CacheInterface
    {
        $toCache = [
            'a' => 0,
            'b' => 1,
            'c' => 2,
            'd' => '3',
        ];
        self::assertTrue(
            $cache->setMultiple($toCache)
        );
        foreach ($toCache as $key => $value) {
            self::assertEquals($value, $cache->get($key));
        }

        return $cache;
    }

    /**
     * @depends testSetMultiple
     * @throws InvalidArgumentException
     */
    public function testGetMultiple(CacheInterface $cache): CacheInterface
    {
        self::assertSame(
            [
                'a' => 0,
                'b' => 1,
                'd' => '3',
                'z' => 'null',
            ],
            $cache->getMultiple(['a', 'b', 'd', 'z'], 'null')
        );

        return $cache;
    }

    /**
     * @depends testGetMultiple
     * @throws InvalidArgumentException
     */
    public function testDeleteMultiple(CacheInterface $cache): CacheInterface
    {
        self::assertTrue(
            $cache->deleteMultiple(['a', 'b'])
        );
        self::assertFalse($cache->has('a'));
        self::assertFalse($cache->has('b'));
        self::assertTrue($cache->has('d'));

        return $cache;
    }

    /**
     * @depends testGetMultiple
     * @throws InvalidArgumentException
     */
    public function testClear(CacheInterface $cache): void
    {
        self::assertTrue($cache->clear());
        self::assertFalse($cache->has('a'));
        self::assertFalse($cache->has('b'));
        self::assertFalse($cache->has('c'));
        self::assertFalse($cache->has('d'));
    }

    public function testSetInvalidKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new InMemoryCache())->set(self::INVALID_KEY, 'value');
    }

    public function testGetInvalidKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new InMemoryCache())->get(self::INVALID_KEY);
    }

    public function testHasInvalidKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new InMemoryCache())->has(self::INVALID_KEY);
    }

    public function testDeleteInvalidKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new InMemoryCache())->delete(self::INVALID_KEY);
    }

    public function testSetMultipleInvalidKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new InMemoryCache())->setMultiple(self::INVALID_MULTIPLE); // @phpstan-ignore-line
    }

    public function testSetMultipleNotIterable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new InMemoryCache())->setMultiple(self::NOT_ITERABLE); // @phpstan-ignore-line
    }

    public function testGetMultipleInvalidKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new InMemoryCache())->getMultiple(self::INVALID_MULTIPLE);
    }

    public function testGetMultipleNotIterable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new InMemoryCache())->getMultiple(self::NOT_ITERABLE); // @phpstan-ignore-line
    }

    public function testDeleteMultipleInvalidKey(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new InMemoryCache())->deleteMultiple(self::INVALID_MULTIPLE);
    }

    public function testDeleteMultipleNotIterable(): void
    {
        $this->expectException(InvalidArgumentException::class);
        (new InMemoryCache())->deleteMultiple(self::NOT_ITERABLE); // @phpstan-ignore-line
    }
}
