<?php

declare(strict_types=1);

namespace Era269\Microobject\Message;

use Era269\Example\Domain\Message\MessageId;
use Era269\Microobject\AbstractNormalizableModel;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\Traits\CreatedAtAwareTrait;
use Era269\Microobject\MessageInterface;

abstract class AbstractMessage extends AbstractNormalizableModel implements MessageInterface
{
    use CreatedAtAwareTrait;

    private IdentifierInterface $sourceObjectId;
    private ?IdentifierInterface $targetObjectId = null;
    private ?IdentifierInterface $replyOnMessageId = null;

    private MessageIdInterface $id;

    public function __construct()
    {
        $this->id = MessageId::create();
    }

    /**
     * {@inheritdoc}
     */
    protected function getNormalized(): array
    {
        return [
            'id' => $this->getId()->normalize(),
            'createdAt' => $this->getCreatedAt()->format(DATE_RFC3339),
            'replyToObjectId' => $this->getSourceObjectId() ? $this->getSourceObjectId()->normalize() : [],
            'replyOnMessageId' => $this->getReplyOnMessageId() ? $this->getReplyOnMessageId()->normalize() : [],
            'targetObjectId' => $this->getTargetObjectId() ? $this->getTargetObjectId()->normalize() : [],
        ];
    }

    public function getId(): MessageIdInterface
    {
        return $this->id;
    }

    public function getSourceObjectId(): IdentifierInterface
    {
        return $this->sourceObjectId;
    }

    protected function setSourceObjectId(IdentifierInterface $id): void
    {
        $this->sourceObjectId = $id;
    }

    public function getReplyOnMessageId(): ?IdentifierInterface
    {
        return $this->replyOnMessageId;
    }

    protected function setReplyOnMessageId(?IdentifierInterface $replyOnMessageId): void
    {
        $this->replyOnMessageId = $replyOnMessageId;
    }

    public function getTargetObjectId(): ?IdentifierInterface
    {
        return $this->targetObjectId;
    }

    protected function setTargetObjectId(?IdentifierInterface $targetObjectId): void
    {
        $this->targetObjectId = $targetObjectId;
    }
}
