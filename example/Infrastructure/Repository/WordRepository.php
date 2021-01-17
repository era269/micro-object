<?php
declare(strict_types=1);

namespace Era269\Example\Infrastructure\Repository;

use Era269\Example\Domain\Notebook\Page\Line\Word\WordRepositoryInterface;
use Era269\Example\Domain\Notebook\Page\Line\WordInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\MicroobjectInterface;
use LogicException;
use SplObjectStorage;
use Traversable;

final class WordRepository implements WordRepositoryInterface
{
    private SplObjectStorage $collection;

    public function __construct()
    {
        $this->collection = new SplObjectStorage();
    }

    /**
     * @inheritDoc
     */
    public function getIterator(): Traversable
    {
        return $this->collection;
    }

    public function count(): int
    {
        return $this->collection->count();
    }

    /**
     * @inheritDoc
     */
    public function get(IdentifierInterface $id): WordInterface
    {
        return $this->collection[$id];
    }

    /**
     * @inheritDoc
     */
    public function attach(MicroobjectInterface $microobject): void
    {
        if ($microobject instanceof WordInterface) {
            $this->attachWord($microobject);
        }
        throw new LogicException(sprintf(
            'Only "%s" allowed. "%s" was given',
            WordInterface::class,
            $microobject::class
        ));
    }

    /**
     * @inheritDoc
     */
    public function attachWord(WordInterface $page): void
    {
        $this->collection[$page->getId()] = $page;
    }

    /**
     * @inheritDoc
     */
    public function detach(MicroobjectInterface $microobject): void
    {
        $this->collection->detach($microobject->getId());
    }

    /**
     * @inheritDoc
     */
    public function contains(IdentifierInterface $id): bool
    {
        return $this->collection->contains($id);
    }
}
