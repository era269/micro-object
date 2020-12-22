<?php

declare(strict_types=1);

namespace Era269\Microobject;

/*
 * Only one instance of class can be a subject, because we have to support only one command and request handler
 */

use ArrayIterator;
use Traversable;

final class SubjectCollection implements SubjectCollectionInterface
{
    /**
     * @var array<string, MicroobjectInterface>
     */
    private array $objects = [];

    public function __construct(MicroobjectInterface ...$objects)
    {
        foreach ($objects as $object) {
            $this->attach($object);
        }
    }

    public function attach(MicroobjectInterface $object): void
    {
        $this->objects[$this->getKey($object)] = $object;
    }

    private function getKey(MicroobjectInterface $object): string
    {
        return get_class($object);
    }

    /**
     * @return Traversable&MicroobjectInterface[]
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->objects);
    }

    public function detach(MicroobjectInterface $object): void
    {
        if ($this->contains($object)) {
            unset($this->objects[$this->getKey($object)]);
        }
    }

    public function contains(MicroobjectInterface $object): bool
    {
        return array_key_exists(
            $this->getKey($object),
            $this->objects
        );
    }

    public function count(): int
    {
        return count($this->objects);
    }

    public function fill(SubjectCollectionInterface $collectionToFill): SubjectCollectionInterface
    {
        foreach ($this->objects as $object) {
            $collectionToFill->attach($object);
        }
        return $collectionToFill;
    }
}
