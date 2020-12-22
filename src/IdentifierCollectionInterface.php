<?php
declare(strict_types=1);


namespace Era269\Microobject;


interface IdentifierCollectionInterface extends CollectionInterface, NormalizableInterface
{
    public function attach(IdentifierInterface ...$ids): void;

    public function detach(IdentifierInterface ...$ids): void;

    public function contains(IdentifierInterface $id): bool;

    public function fill(IdentifierCollectionInterface $collectionToFill): IdentifierCollectionInterface;
}
