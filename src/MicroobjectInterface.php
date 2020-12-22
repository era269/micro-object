<?php

declare(strict_types=1);

namespace Era269\Microobject;

interface MicroobjectInterface extends
    RouterAwareInterface,
    NormalizableInterface,
    SelfDocumentedInterface,
    MessageProcessorInterface
{
    public function getId(): IdentifierInterface;
}
