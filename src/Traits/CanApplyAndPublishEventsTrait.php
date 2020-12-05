<?php

declare(strict_types=1);

namespace Era269\TrueObject\Traits;

use Era269\TrueObject\Message\EventInterface;
use Era269\TrueObject\Message\Event\EventSubscriberInterface;
use SplObjectStorage;

/*
 * implements \Era269\TrueObject\SubjectInterface
 */

trait CanApplyAndPublishEventsTrait
{
    use CanBuildMethodNameByFormat;

    /**
     * @var SplObjectStorage&EventSubscriberInterface[]
     */
    private SplObjectStorage $subscribers; // ->php8 WeakMap to keep subscriptions only on existing objects

    /**
     * @var SplObjectStorage&\Era269\TrueObject\Message\EventInterface[]
     */
    private SplObjectStorage $publishedEvents;

    final public function publish(EventInterface ...$events): void
    {
        foreach ($events as $event) {
            $this->publishThat($event);
        }
    }

    final public function attachSubscriber(EventSubscriberInterface ...$subscribers): void
    {
        foreach ($subscribers as $subscriber) {
            $this->subscribers->attach($subscriber);
            $this->notifySubscriber($subscriber);
        }
    }

    final public function detachSubscriber(EventSubscriberInterface ...$subscribers): void
    {
        foreach ($subscribers as $observer) {
            $this->subscribers->detach($observer);
        }
    }

    final protected function publishThat(EventInterface $event): void
    {
        $this->publishedEvents->attach($event);
        foreach ($this->subscribers as $subscriber) {
            $subscriber->notifyMe($event);
        }
    }

    final protected function applyThat(EventInterface $event): void
    {
        $methodName = $this->buildMethodName('apply%s', $event);

        if (!method_exists($this, $methodName)) {
            return;
        }
        $this->$methodName($event);

//        $this->updatedAt = $event->getOccurredAt();
    }

    private function notifySubscriber(EventSubscriberInterface $subscriber): void
    {
        $subscriber->notifyMe(...$this->publishedEvents);
    }

    private function initSubscribers(): void
    {
        $this->subscribers = new SplObjectStorage();
    }

    private function initEvents(): void
    {
        $this->publishedEvents = new SplObjectStorage();
    }
}
