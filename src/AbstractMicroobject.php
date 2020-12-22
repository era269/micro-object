<?php

declare(strict_types=1);

namespace Era269\Microobject;

use DateTimeInterface;
use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\EventInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\Router\BaseRouter;
use Era269\Microobject\Traits\CanDetectIsMethodCallerInstanceOf;
use Era269\Microobject\Traits\CanShareMyInterfaceDocumentation;
use Era269\Microobject\Traits\RouterAwareTrait;

abstract class AbstractMicroobject extends AbstractNormalizableModel implements MicroobjectInterface
{
    use CanDetectIsMethodCallerInstanceOf;
    use CanShareMyInterfaceDocumentation;
    use RouterAwareTrait;

    private DateTimeInterface $updatedAt;

    public function __construct(MicroobjectInterface ...$subjects)
    {
        $this->withRouter(new BaseRouter($this, ...$subjects));
    }

    /**
     * {@inheritdoc}
     */
    final public function process(MessageInterface $message): ReplyInterface
    {
        if (!$this->isMethodCallerInstanceOfAny(RouterInterface::class, MicroobjectInterface::class)) {
            return $this->send($message);
        }
        $methodName = $this->getInterfaceDocumentation()[get_class($message)];
        return $this->$methodName($message);
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function applyAndPublishThat(EventInterface $event): void
    {
        $this->applyThat($event);
        $this->publishThat($event);
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function publishThat(EventInterface $event): void
    {
        $this->send($event);
    }

    final protected function applyThat(EventInterface $event): void
    {
        $methodName = $this->getInterfaceDocumentation()[get_class($event)];
        $this->$methodName($event);
    }
}
