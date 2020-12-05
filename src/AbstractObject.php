<?php

declare(strict_types=1);

namespace Era269\TrueObject;

use DateTimeInterface;
use Era269\TrueObject\Message\Event\EventPublisherInterface;
use Era269\TrueObject\Message\EventInterface;
use Era269\TrueObject\Traits\CanApplyAndPublishEventsTrait;
use Era269\TrueObject\Traits\CanDoCommandTrait;
use Era269\TrueObject\Traits\CanHandleRequestTrait;

abstract class AbstractObject implements TrueObjectInterface
{
    use CanApplyAndPublishEventsTrait;
    use CanDoCommandTrait;
    use CanHandleRequestTrait;

    private DateTimeInterface $updatedAt;
    /**
     * @var Subjects&TrueObjectInterface[]
     */
    private Subjects $subjects;

    public function __construct(TrueObjectInterface ...$subjectsToSubscribeOn)
    {
        $this->initEvents();
        $this->initSubjects();
        $this->initSubscribers();
        $this->subscribeOnAndAttachToSubjectQueue(...$subjectsToSubscribeOn);
    }

//    public static function reconstitute(History $history, TrueObjectInterface ...$subjectsToSubscribeOn)
//    : TrueObjectInterface
//    {
//        $self = new static(...$subjectsToSubscribeOn);
//        foreach ($history as $event) {
//            $self->applyThat($event);
//        }
//
//        return $self;
//    }

//    public static function create(TrueObjectInterface ...$subjectsToSubscribeOn)
//    : TrueObjectInterface
//    {
//        return new static(...$subjectsToSubscribeOn);
//    }

    public function notifyMe(EventInterface ...$events)
    : void
    {
        foreach ($events as $event) {
            $this->applyAndPublishThat($event);
        }
    }

    public function attachSubject(TrueObjectInterface ...$subjects)
    : void
    {
        foreach ($subjects as $subject) {
            $this->subjects->attach($subject);
        }
    }

    public function detachSubject(TrueObjectInterface ...$subjects)
    : void
    {
        foreach ($subjects as $subject) {
            $this->subjects->detach($subject);
        }
    }

    final protected function applyAndPublishThat(EventInterface $event)
    : void
    {
        $this->applyThat($event);
        $this->publishThat($event);
    }

    final protected function subscribeOnAndAttachToSubjectQueue(EventPublisherInterface ...$publishers)
    : void
    {
        $this->subscribeOn(...$publishers);
        $this->attachSubject(...$publishers);
    }

    final protected function subscribeOn(EventPublisherInterface ...$publishers)
    : void
    {
        foreach ($publishers as $publisher) {
            $publisher->attachSubscriber($this);
        }
    }

    private function initSubjects()
    : void
    {
        $this->subjects = new Subjects();
    }
}
