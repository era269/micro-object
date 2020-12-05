<?php

declare(strict_types=1);

namespace Era269\TrueObject;

/*
 * Only one instance of class can be a subject, because we have to support only one command and request handler
 */

use ArrayIterator;
use IteratorAggregate;
use Traversable;

final class Subjects implements IteratorAggregate
{
    /**
     * @var array<string, TrueObjectInterface>
     */
    private array $objects = [];

    public function __construct(TrueObjectInterface ...$objects)
    {
        foreach ($objects as $object) {
            $this->attach($object);
        }
    }

    /**
     * @return Traversable&TrueObjectInterface[]
     */
    public function getIterator()
    : Traversable
    {
        return new ArrayIterator($this->objects);
    }

    public function attach(TrueObjectInterface $object)
    : void
    {
        $this->objects[get_class($object)] = $object;
    }

    public function detach(TrueObjectInterface $object)
    : void
    {
        if ($this->contains($object)) {
            unset($this->objects[get_class($object)]);
        }
    }

    public function contains(TrueObjectInterface $object)
    : bool
    {
        return array_key_exists(
            get_class($object),
            $this->objects
        );
    }
}
