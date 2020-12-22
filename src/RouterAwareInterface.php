<?php
declare(strict_types=1);


namespace Era269\Microobject;


use Era269\Microobject\Exception\ExceptionInterface;

interface RouterAwareInterface
{
    /**
     * @throws ExceptionInterface
     */
    public function withRouter(RouterInterface $router): void;
}
