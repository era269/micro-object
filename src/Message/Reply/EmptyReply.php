<?php
declare(strict_types=1);


namespace Era269\Microobject\Message\Reply;


use Era269\Microobject\Normalizable\NullNormalizable;
use Era269\Microobject\NormalizableInterface;

class EmptyReply extends BaseReply
{
    public function getPayload(): NormalizableInterface
    {
        return new NullNormalizable();
    }
}
