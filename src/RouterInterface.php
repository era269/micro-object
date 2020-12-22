<?php
declare(strict_types=1);


namespace Era269\Microobject;


use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\ReplyInterface;

interface RouterInterface
{
    public function attach(MicroobjectInterface $microobject): void;

    public function detach(MicroobjectInterface $microobject): void;

    public function fill(RouterInterface $router): void;

    /**
     * @throws ExceptionInterface
     */
    public function send(MessageInterface $message): ReplyInterface;
}
