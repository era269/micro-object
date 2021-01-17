<?php
declare(strict_types=1);


namespace Era269\Microobject;


use DomainException;

interface RouterAwareInterface
{
    /**
     * @throws DomainException
     */
    public function withRouter(RouterInterface $router): void;
}
