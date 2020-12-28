<?php
declare(strict_types=1);


namespace Era269\Microobject\Router;


use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Exception\MicroobjectException;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\MessageIdInterface;
use Era269\Microobject\Message\Reply\NullReply;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\MicroobjectInterface;
use Era269\Microobject\RouterInterface;
use SplObjectStorage;
use WeakMap;

class BaseRouter implements RouterInterface
{
    /**
     * @var array<string, WeakMap&MicroobjectInterface[]>
     */
    private array $processingMap;

    /**
     * @var array<IdentifierInterface, MicroobjectInterface> & WeakMap & IdentifierInterface[]
     */
    private WeakMap $processorRegistry;

    /**
     * @var array<MessageIdInterface, MessageInterface> & SplObjectStorage & MessageIdInterface[]
     */
    private SplObjectStorage $messageRegistry;

    public function __construct(MicroobjectInterface ...$microobjects)
    {
        $this->processorRegistry = new WeakMap();
        $this->messageRegistry = new SplObjectStorage();
        foreach ($microobjects as $microobject) {
            $this->attach($microobject);
        }
    }

    public function attach(MicroobjectInterface $microobject): void
    {
        $this->attachToProcessorRegistry($microobject);
        foreach ($microobject->getInterfaceDocumentation() as $messageClassName => $methodName) {
            $this->attachToProcessingMap($messageClassName, $microobject);
        }
    }

    public function detach(MicroobjectInterface $microobject): void
    {
        $this->detachFromProcessorRegistry($microobject);
        $this->detachFromProcessingMap($microobject);
    }

    /**
     * {@inheritdoc}
     */
    public function send(MessageInterface $message): ReplyInterface
    {
        $this->assertProcessorExistsFor($message);
        // ToDo: do we need that check?
        $this->assertWasNotProcessed($message);
        $this->attachMessage($message);

        return $message->getTargetObjectId()
            ? $this->routeProcessingToTargetObject($message)
            : $this->routeProcessingToAllObjects($message);
    }

    /**
     * @throws MicroobjectException
     */
    private function assertProcessorExistsFor(MessageInterface $message): void
    {
        $messageClassName = get_class($message);
        if (empty($this->processingMap[$messageClassName])) {
            throw new MicroobjectException(sprintf(
                "No processors found for '%s'",
                $messageClassName
            ));
        }
    }

    /**
     * @throws MicroobjectException
     */
    private function assertWasNotProcessed(MessageInterface $message): void
    {
        if ($this->messageRegistry->offsetExists($message->getId())) {
            throw new MicroobjectException(sprintf(
                'Message "%s" was already processed',
                get_class($message)
            ));
        }
    }

    private function attachMessage(MessageInterface $message): void
    {
        $this->messageRegistry[$message->getId()] = $message;
    }

    /**
     * @throws ExceptionInterface
     */
    private function routeProcessingToTargetObject(MessageInterface $message): ReplyInterface
    {
        return $this->processorRegistry[$message->getTargetObjectId()]
            ->process($message);
    }

    /**
     * @throws ExceptionInterface
     */
    private function routeProcessingToAllObjects(MessageInterface $message): ReplyInterface
    {
        foreach ($this->processingMap[get_class($message)] as $microobject) {
            // skip the object which sent that message
            if ($microobject->getId()->equals($message->getTargetObjectId())) {
                continue;
            }
            $reply = $microobject->process($message);
        }
        return $reply ?? new NullReply($message);
    }

    /**
     * @inheritDoc
     */
    public function fill(RouterInterface $router): void
    {
        foreach ($this->messageRegistry as $messageId) {
            $router->send(
                $this->messageRegistry[$messageId]
            );
        }
        foreach ($this->processorRegistry as $processor) {
            $router->attach($processor);
        }
    }

    private function attachToProcessingMap(string $messageClassName, MicroobjectInterface $microobject): void
    {
        if (empty($this->processingMap[$messageClassName])) {
            $this->processingMap[$messageClassName] = new WeakMap();
        }
        $this->processingMap[$messageClassName][] = $microobject;
    }

    private function attachToProcessorRegistry(MicroobjectInterface $microobject): void
    {
        $this->processorRegistry[$microobject->getId()] = $microobject;
    }

    private function detachFromProcessingMap(MicroobjectInterface $microobject): void
    {
        foreach ($microobject->getInterfaceDocumentation() as $messageClassName) {
            unset($this->processingMap[$messageClassName][$microobject]);
        }
    }

    private function detachFromProcessorRegistry(MicroobjectInterface $microobject): void
    {
        unset($this->processorRegistry[$microobject->getId()]);
    }
}
