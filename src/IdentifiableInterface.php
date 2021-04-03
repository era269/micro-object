<?php

declare(strict_types=1);

namespace Era269\Microobject;

interface IdentifiableInterface
{
    public function getId(): IdentifierInterface;
}
