<?php

declare(strict_types=1);

namespace Era269\TrueObject\Message\Request;

use Era269\TrueObject\Message\AbstractMessage;
use Era269\TrueObject\Message\RequestInterface;

abstract class AbstractRequest extends AbstractMessage implements RequestInterface
{
    private RequestId $id;

    public function __construct()
    {
        $this->id = new RequestId();
        $this->setCreatedAt();
    }

    public function getId()
    : RequestId
    {
        return $this->id;
    }
}
