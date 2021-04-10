<?php
declare(strict_types=1);

namespace Era269\Microobject\Message\Response;

use Era269\Microobject\Identifier\NullMessageIdentifier;
use Era269\Microobject\Message\ResponseInterface;
use Era269\Microobject\Message\Traits\MessageTrait;
use Era269\Microobject\Normalizable\NullNormalizable;
use Era269\Normalizable\Abstraction\AbstractNormalizable;

final class NullResponse extends AbstractNormalizable implements ResponseInterface
{
    use MessageTrait;

    public function __construct()
    {
        $this->setCreatedAt();
        $this->setId(NullMessageIdentifier::generate());
        $this->setPayload(new NullNormalizable());
    }
}
