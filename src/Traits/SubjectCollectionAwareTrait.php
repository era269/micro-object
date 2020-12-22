<?php
declare(strict_types=1);


namespace Era269\Microobject\Traits;


use Era269\Microobject\MicroobjectInterface;
use Era269\Microobject\SubjectCollectionInterface;

trait SubjectCollectionAwareTrait
{
    private SubjectCollectionInterface $subjectCollection;

    public function withSubjectCollection(SubjectCollectionInterface $subjectCollection): void
    {
        if (isset($this->subjectCollection)) {
            $this->subjectCollection->fill($subjectCollection);
        }
        $this->subjectCollection = $subjectCollection;
    }

    public function attachSubject(MicroobjectInterface ...$subjects): void
    {
        foreach ($subjects as $subject) {
            $this->getSubjectCollection()->attach($subject);
        }
    }

    public function detachSubject(MicroobjectInterface ...$subjects): void
    {
        foreach ($subjects as $subject) {
            $this->getSubjectCollection()->detach($subject);
        }
    }

    private function getSubjectCollection(): SubjectCollectionInterface
    {
        return $this->subjectCollection;
    }
}
