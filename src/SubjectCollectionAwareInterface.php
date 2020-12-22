<?php

declare(strict_types=1);

namespace Era269\Microobject;

interface SubjectCollectionAwareInterface
{
    public function withSubjectCollection(SubjectCollectionInterface $subjectCollection): void;

    public function attachSubject(MicroobjectInterface ...$subjects): void;

    public function detachSubject(MicroobjectInterface ...$subjects): void;
}
