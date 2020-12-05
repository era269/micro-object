<?php

declare(strict_types=1);

namespace Era269\TrueObject\Traits;

use Era269\TrueObject\Message\EventInterface;
use RuntimeException;
use SplObjectStorage;

trait CanStoreObjects
{
    private SplObjectStorage $storage;

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->storage->getInfo();
    }

    /**
     * @param mixed $data
     */
    public function setInfo($data)
    : void
    {
        $this->storage->setInfo($data);
    }

    public function count()
    : int
    {
        return $this->storage->count();
    }

    public function rewind()
    : void
    {
        $this->storage->rewind();
    }

    public function valid()
    : bool
    {
        return $this->storage->valid();
    }

    public function key()
    : int
    {
        return $this->storage->key();
    }

    public function next()
    : void
    {
        $this->storage->next();
    }

    public function unserialize($serialized)
    : void
    {
        $this->storage->unserialize($serialized);
    }

    public function serialize()
    : string
    {
        return $this->storage->serialize();
    }

    public function offsetExists($object)
    : bool
    {
        return $this->storage->offsetExists($object);
    }

    /**
     * @param EventInterface $object
     * @param mixed|null $data
     */
    public function offsetSet($object, $data = null)
    : void
    {
        $this->throwRuntimeExceptionIfObjectIsInappropriate($object);
        $this->storage->offsetSet($object, $data);
    }

    /**
     * @param EventInterface $object
     */
    public function offsetUnset($object)
    : void
    {
        $this->throwRuntimeExceptionIfObjectIsInappropriate($object);
        $this->storage->offsetUnset($object);
    }

    /**
     * @param EventInterface $object
     *
     * @return mixed
     */
    public function offsetGet($object)
    {
        $this->throwRuntimeExceptionIfObjectIsInappropriate($object);
        return $this->storage->offsetGet($object);
    }

    public function getHash(EventInterface $object)
    : string
    {
        return $this->storage->getHash($object);
    }

    public function __serialize()
    : array
    {
        return $this->storage->__serialize();
    }

    public function __unserialize(array $data)
    : void
    {
        $this->storage->__unserialize($data);
    }

    public function __debugInfo()
    : array
    {
        return $this->storage->__debugInfo();
    }

    private function throwRuntimeExceptionIfObjectIsInappropriate(EventInterface $object)
    : void
    {
        if ($object instanceof EventInterface) {
            return;
        }
        throw new RuntimeException(sprintf(
            'Can store only "%s". "%s" was given',
            $this->getStoredClassName(),
            get_class($object)
        ));
    }

    private function initStorage()
    : void
    {
        $this->storage = new SplObjectStorage();
    }

    /**
     * @return string
     */
    private function getStoredClassName()
    : string
    {
        return EventInterface::class;
    }
}
