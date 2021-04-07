<?php
declare(strict_types=1);

namespace Era269\Microobject\Message\Response;

use Era269\Microobject\Identifier\NullMessageIdentifier;
use Era269\Microobject\Message\ResponseInterface;
use Era269\Microobject\Message\Traits\MessageTrait;
use Era269\Microobject\Normalizable\NullNormalizable;
use Era269\Normalizable\AbstractNormalizableObject;

final class NullResponse extends AbstractNormalizableObject implements ResponseInterface
{
    use MessageTrait;

    public function __construct()
    {
        $this->setCreatedAt();
        $this->setId(NullMessageIdentifier::generate());
        $this->setPayload(new NullNormalizable());
    }
}
