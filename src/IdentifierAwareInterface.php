<?php

declare(strict_types=1);

namespace Era269\TrueObject;

interface IdentifierAwareInterface
{
    public function getId(): IdentifierInterface;
}
