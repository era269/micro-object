<?php

declare(strict_types=1);

namespace Era269\Microobject\Message;

use Era269\Microobject\Example\Domain\Message\MessageId;
use Era269\Microobject\Message\Traits\CreatedAtAwareTrait;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\Normalizable\NullNormalizable;
use Era269\Normalizable\AbstractNormalizableObject;
use Era269\Normalizable\NormalizableInterface;

abstract class AbstractMessage extends AbstractNormalizableObject implements MessageInterface
{
    use CreatedAtAwareTrait;

    private MessageIdInterface $id;
    private NormalizableInterface $payload;

    public function __construct()
    {
        $this->setId(MessageId::generate());
        $this->setCreatedAt();
        $this->setPayload(new NullNormalizable());
    }

    final protected function setId(MessageIdInterface|MessageId $id): void
    {
        $this->id = $id;
    }

    public function getId(): MessageIdInterface
    {
        return $this->id;
    }

    public function getPayload(): NormalizableInterface
    {
        return $this->payload;
    }

    final protected function setPayload(NormalizableInterface $payload): void
    {
        $this->payload = $payload;
    }

    /**
     * {@inheritdoc}
     */
    protected function getNormalized(): array
    {
        return [
            'id' => $this->getId()->normalize(),
            'createdAt' => $this->createdAt->normalize(),
            'payload' => $this->getPayload()->normalize(),
        ];
    }
}
