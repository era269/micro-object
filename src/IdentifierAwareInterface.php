<?php

declare(strict_types=1);

namespace Era269\Microobject;

interface IdentifierAwareInterface
{
    public function getId(): IdentifierInterface;
}
