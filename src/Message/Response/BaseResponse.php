<?php

declare(strict_types=1);

namespace Era269\Microobject\Message\Response;

use Era269\Microobject\Example\Domain\Message\AbstractMessage;
use Era269\Microobject\Message\ResponseInterface;
use Era269\Normalizable\NormalizableInterface;

class BaseResponse extends AbstractMessage implements ResponseInterface
{
    public function __construct(
        NormalizableInterface $payload
    )
    {
        parent::__construct();
        $this->setPayload($payload);
    }
}
