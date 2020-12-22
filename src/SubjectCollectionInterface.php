<?php
declare(strict_types=1);


namespace Era269\Microobject;


use Traversable;

interface SubjectCollectionInterface extends CollectionInterface
{
    public function fill(SubjectCollectionInterface $collectionToFill): SubjectCollectionInterface;

    public function attach(MicroobjectInterface $object): void;

    public function detach(MicroobjectInterface $object): void;

    public function contains(MicroobjectInterface $object): bool;

    /**
     * @return Traversable&MicroobjectInterface[]
     */
    public function getIterator(): Traversable;
}
