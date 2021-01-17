<?php
declare(strict_types=1);

namespace Era269\Example\Infrastructure\Repository;

use Era269\Example\Domain\Notebook\Page\Line\LineRepositoryInterface;
use Era269\Example\Domain\Notebook\Page\LineInterface;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\MicroobjectInterface;
use LogicException;
use SplObjectStorage;
use Traversable;

final class LineRepository implements LineRepositoryInterface
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
    public function get(IdentifierInterface $id): LineInterface
    {
        return $this->collection[$id];
    }

    /**
     * @inheritDoc
     */
    public function attach(MicroobjectInterface $microobject): void
    {
        if ($microobject instanceof LineInterface) {
            $this->attachLine($microobject);
        }
        throw new LogicException(sprintf(
            'Only "%s" allowed. "%s" was given',
            LineInterface::class,
            $microobject::class
        ));
    }

    /**
     * @inheritDoc
     */
    public function attachLine(LineInterface $page): void
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
