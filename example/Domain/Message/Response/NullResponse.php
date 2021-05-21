<?php

declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Response;

use Era269\Microobject\Example\Domain\Message\AbstractMessage;
use Era269\Microobject\Message\ResponseInterface;

final class NullResponse extends AbstractMessage implements ResponseInterface
{
}
