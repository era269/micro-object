<?php
declare(strict_types=1);


namespace Era269\Microobject\Message;


use Era269\Microobject\Message\Exception\MessageAlreadyInCollectionException;
use Era269\Microobject\MessageInterface;
use SplObjectStorage;
use Traversable;

class MessageCollection implements MessageCollectionInterface
{
    /**
     * @var SplObjectStorage&MessageInterface[]
     */
    private SplObjectStorage $messages;

    public function __construct()
    {
        $this->messages = new SplObjectStorage();
    }

    public function attach(MessageInterface $message): void
    {
        if ($this->contains($message)) {
            throw new MessageAlreadyInCollectionException($message);
        }
        $this->messages->attach($message);
    }

    public function contains(MessageInterface $message): bool
    {
        return $this->messages->contains($message);
    }

    public function detach(MessageInterface $message): void
    {
        $this->messages->detach($message);
    }

    /**
     * @return Traversable&MessageInterface[]
     */
    public function getIterator(): Traversable
    {
        return $this->messages;
    }

    public function count(): int
    {
        return $this->messages->count();
    }
}
