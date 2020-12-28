<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\EventInterface;

interface ReconstitutableInterface extends NormalizableInterface
{
    /**
     * @throws ExceptionInterface
     */
    public static function reconstitute(EventInterface ...$events): static;
}
