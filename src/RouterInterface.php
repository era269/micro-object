<?php
declare(strict_types=1);


namespace Era269\Microobject;


use DomainException;
use Era269\Microobject\Message\ReplyInterface;

interface RouterInterface
{
    public function attach(MicroobjectInterface $microobject): void;

    public function detach(MicroobjectInterface $microobject): void;

    /**
     * @throws DomainException
     */
    public function fill(RouterInterface $router): void;

    /**
     * @throws DomainException
     */
    public function send(MessageInterface $message): ReplyInterface;
}
