<?php
declare(strict_types=1);

namespace Era269\Microobject;

use OutOfBoundsException;

interface RepositoryInterface extends CollectionInterface
{
    /**
     * @throws OutOfBoundsException
     */
    public function get(IdentifierInterface $id): MicroobjectInterface;

    public function attach(MicroobjectInterface $microobject): void;

    public function detach(MicroobjectInterface $microobject): void;

    public function contains(IdentifierInterface $id): bool;
}
