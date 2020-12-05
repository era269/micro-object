<?php

declare(strict_types=1);

namespace Era269\TrueObject\Message\Request;

use Era269\TrueObject\Exception\ExceptionInterface;
use Era269\TrueObject\Message\RequestInterface;

interface HandleRequestInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function handle(RequestInterface $query): ResponseInterface;
}
