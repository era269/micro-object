<?php
declare(strict_types=1);


namespace Era269\Microobject;


use Era269\Microobject\Exception\ExceptionInterface;

interface RepositoryInterface extends CollectionInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function get(IdentifierInterface $id): MicroobjectInterface;

    /**
     * @throws ExceptionInterface
     */
    public function attach(MicroobjectInterface $microobject): void;

    /**
     * @throws ExceptionInterface
     */
    public function detach(MicroobjectInterface $microobject): void;

    /**
     * @throws ExceptionInterface
     */
    public function contains(IdentifierInterface $id): bool;
}
