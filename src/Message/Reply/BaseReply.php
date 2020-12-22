<?php
declare(strict_types=1);

namespace Era269\Microobject\Message\Reply;

use Era269\Example\Domain\Message\MessageId;
use Era269\Microobject\AbstractNormalizableModel;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\MessageIdInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\Message\Traits\CreatedAtAwareTrait;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\Normalizable\NullNormalizable;
use Era269\Microobject\NormalizableInterface;

class BaseReply extends AbstractNormalizableModel implements ReplyInterface
{
    use CreatedAtAwareTrait;

    private ?IdentifierInterface $sourceObjectId = null;
    private IdentifierInterface $targetObjectId;
    private IdentifierInterface $replyOnMessageId;

    private MessageId $id;
    private NormalizableInterface $payload;

    public function __construct(MessageInterface $message, ?NormalizableInterface $payload = null)
    {
        $this->id = MessageId::create();
        $this->setTargetObjectId($message->getSourceObjectId());
        $this->setSourceObjectId($message->getTargetObjectId());
        $this->setReplyOnMessageId($message->getId());
        $this->setPayload($payload);
    }

    public function getPayload(): NormalizableInterface
    {
        return $this->payload;
    }

    /**
     * {@inheritdoc}
     */
    protected function getNormalized(): array
    {
        return [
            'id' => $this->getId()->normalize(),
            'createdAt' => $this->getCreatedAt()->format(DATE_RFC3339),
            'sourceObjectId' => $this->getSourceObjectId(),
            'replyOnMessageId' => $this->getReplyOnMessageId()->normalize(),
            'targetObjectId' => $this->getTargetObjectId()->normalize(),
            'payload' => $this->getPayload()->normalize(),
        ];
    }

    final public function getId(): MessageIdInterface
    {
        return $this->id;
    }

    final public function getSourceObjectId(): IdentifierInterface
    {
        return $this->sourceObjectId;
    }

    final protected function setSourceObjectId(?IdentifierInterface $id): void
    {
        $this->sourceObjectId = $id;
    }

    final public function getReplyOnMessageId(): IdentifierInterface
    {
        return $this->replyOnMessageId;
    }

    final protected function setReplyOnMessageId(IdentifierInterface $replyOnMessageId): void
    {
        $this->replyOnMessageId = $replyOnMessageId;
    }

    final public function getTargetObjectId(): IdentifierInterface
    {
        return $this->targetObjectId;
    }

    final protected function setTargetObjectId(IdentifierInterface $targetObjectId): void
    {
        $this->targetObjectId = $targetObjectId;
    }

    final protected function setPayload(?NormalizableInterface $payload)
    {
        $this->payload = $payload ?? new NullNormalizable();
    }
}
