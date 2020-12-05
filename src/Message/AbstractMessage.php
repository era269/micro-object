<?php

declare(strict_types=1);

namespace Era269\TrueObject\Message;

use Era269\TrueObject\AbstractNormalizableModel;
use Era269\TrueObject\MessageInterface;
use Era269\TrueObject\Traits\CreatedAtAwareTrait;

abstract class AbstractMessage extends AbstractNormalizableModel implements MessageInterface
{
    use CreatedAtAwareTrait;

    /**
     * {@inheritdoc}
     */
    protected function getNormalized()
    : array
    {
        return [
            'id' => $this->getId()->normalized(),
            'createdAt' => $this->getCreatedAt()->format(DATE_RFC3339),
        ];
    }
}
