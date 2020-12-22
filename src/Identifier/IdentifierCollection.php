<?php
declare(strict_types=1);


namespace Era269\Microobject\Identifier;


use Era269\Microobject\AbstractNormalizableModel;
use Era269\Microobject\IdentifierCollectionInterface;
use Era269\Microobject\IdentifierInterface;
use SplObjectStorage;

final class IdentifierCollection extends AbstractNormalizableModel implements IdentifierCollectionInterface
{
    /**
     * @var SplObjectStorage&IdentifierInterface[]
     */
    private SplObjectStorage $collection;

    public function __construct(IdentifierInterface ...$ids)
    {
        $this->collection = new SplObjectStorage();
        $this->attach(...$ids);
    }

    /**
     * @return SplObjectStorage&IdentifierInterface[]
     */
    public function getIterator(): SplObjectStorage
    {
        return $this->collection;
    }

    public function count(): int
    {
        return $this->collection->count();
    }

    public function attach(IdentifierInterface ...$ids): void
    {
        foreach ($ids as $id) {
            $this->collection->attach($id);
        }
    }

    public function detach(IdentifierInterface ...$ids): void
    {
        foreach ($ids as $id) {
            $this->collection->detach($id);
        }
    }

    public function fill(IdentifierCollectionInterface $collectionToFill): IdentifierCollectionInterface
    {
        foreach ($this->collection as $identifier) {
            $collectionToFill->attach($identifier);
        }
        return $collectionToFill;
    }

    public function contains(IdentifierInterface $id): bool
    {
        return $this->collection->contains($id);
    }

    protected function getNormalized(): array
    {
        return [
            'collection' => array_map(
                fn(IdentifierInterface $id) => $id->normalize(),
                $this->collection
            )
        ];
    }
}
