<?php

declare(strict_types=1);

namespace Era269\Microobject\Exception;

use Exception;

class MicroobjectException extends Exception implements ExceptionInterface
{

    public function normalize(): array
    {
        // TODO: Implement normalized() method.
    }
}
