<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message;

use Era269\Microobject\MessageInterface;
use Era269\Microobject\Traits\MessageTrait;
use Era269\Normalizable\Traits\SimpleNormalizableTrait;

abstract class AbstractMessage implements MessageInterface
{
    use MessageTrait;
    use SimpleNormalizableTrait;

    public function __construct()
    {
        $this->setId(MessageId::generate());
    }

    /**
     * @return array<string, mixed>
     */
    protected function getNormalized(): array
    {
        return $this->getAutoNormalized();
    }
}
