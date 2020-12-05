<?php

declare(strict_types=1);

namespace Era269\TrueObject;

interface SubjectCollectionAwareInterface
{
    public function attachSubject(TrueObjectInterface ...$subjects)
    : void;

    public function detachSubject(TrueObjectInterface ...$subjects)
    : void;
}
