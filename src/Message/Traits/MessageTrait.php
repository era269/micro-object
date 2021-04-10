<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Traits;

use Era269\Microobject\Message\MessageIdInterface;
use Era269\Normalizable\NormalizableInterface;

trait MessageTrait
{
    use CreatedAtAwareTrait;

    private MessageIdInterface $id;
    private NormalizableInterface $payload;

    public function getId(): MessageIdInterface
    {
        return $this->id;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getNormalized(): array
    {
        return [
            'id' => $this->getId()->normalize(),
            'createdAt' => $this->createdAt->normalize(),
            'payload' => $this->getPayload()->normalize(),
        ];
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
