<?php
declare(strict_types=1);


namespace Era269\Microobject\Message\Reply;


use Era269\Microobject\Normalizable\NullNormalizable;
use Era269\Microobject\NormalizableInterface;

final class VoidReply extends EmptyReply
{
    public function getPayload(): NormalizableInterface
    {
        return new NullNormalizable();
    }
}
