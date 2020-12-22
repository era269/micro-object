<?php
declare(strict_types=1);


namespace Era269\Microobject\Traits;


use Era269\Microobject\IdentifierCollectionInterface;

trait IdentifierCollectionAwareTrait
{
    private IdentifierCollectionInterface $identifierCollection;

    public function withIdentifierCollection(IdentifierCollectionInterface $identifierCollection): void
    {
        $this->identifierCollection = $identifierCollection->fill(
            $this->identifierCollection
        );
    }

    private function getIdentifierCollection(): IdentifierCollectionInterface
    {
        return $this->identifierCollection;
    }
}
