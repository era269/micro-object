<?php

declare(strict_types=1);

namespace Era269\Microobject;

use DomainException;
use Era269\Microobject\Message\EventInterface;

interface ReconstitutableInterface extends NormalizableInterface
{
    /**
     * @throws DomainException
     */
    public static function reconstitute(EventInterface ...$events): static;
}
