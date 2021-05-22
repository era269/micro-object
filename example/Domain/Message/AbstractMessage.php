<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message;

use Era269\Microobject\MessageInterface;
use Era269\Microobject\Traits\MessageTrait;
use ReflectionClass;

abstract class AbstractMessage implements MessageInterface
{
    use MessageTrait;

    public function __construct()
    {
        $this->setId(MessageId::generate());
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return (new ReflectionClass(static::class))
            ->getShortName();
    }
}
