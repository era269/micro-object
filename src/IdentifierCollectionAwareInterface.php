<?php
declare(strict_types=1);


namespace Era269\Microobject;


interface IdentifierCollectionAwareInterface
{
    public function withIdentifierCollection(IdentifierCollectionInterface $identifierCollection): void;
}
