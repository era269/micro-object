<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Reply;

use Era269\Example\Domain\Message\Notebook\NotebookCollectionMessageInterface;
use Era269\Microobject\Message\Reply\BaseReply;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\NormalizableInterface;

final class NotebookCollectionReply extends BaseReply implements NotebookCollectionMessageInterface
{
    public function __construct(MessageInterface $message, NormalizableInterface $payload)
    {
        parent::__construct($message);
        $this->setPayload($payload);
    }
}
