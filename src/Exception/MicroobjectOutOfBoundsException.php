<?php

declare(strict_types=1);

namespace Era269\Microobject\Exception;


use Era269\Microobject\IdentifierInterface;
use Throwable;

final class MicroobjectOutOfBoundsException extends MicroobjectRuntimeException
{
    public function __construct(IdentifierInterface $searchId, string $searchModelType, Throwable $previous = null)
    {
        $message = sprintf(
            'No "%s" found by ID:"%s"',
            $searchModelType,
            (string) $searchId
        );

        parent::__construct($message, 0, $previous);
    }
}
