<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Traits;

use Era269\Microobject\Message\MessageIdInterface;
use Era269\Normalizable\NormalizableInterface;
use Era269\Normalizable\Traits\AbstractNormalizableTrait;
use Era269\Normalizable\Traits\SimpleNormalizableTrait;

trait MessageTrait
{
    use CreatedAtAwareTrait;
    use AbstractNormalizableTrait;
    use SimpleNormalizableTrait;

    protected MessageIdInterface $id;
    protected NormalizableInterface $payload;

    /**
     * @return array<string, mixed>
     */
    protected function getNormalized(): array
    {
        return $this->getAutoNormalized();
    }

    public function getId(): MessageIdInterface
    {
        return $this->id;
    }

    final protected function setId(MessageIdInterface $id): void
    {
        $this->id = $id;
    }

    public function getPayload(): NormalizableInterface
    {
        return $this->payload;
    }

    final protected function setPayload(NormalizableInterface $payload): void
    {
        $this->payload = $payload;
    }
}
