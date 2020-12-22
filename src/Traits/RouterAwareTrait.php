<?php
declare(strict_types=1);


namespace Era269\Microobject\Traits;

use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\MessageInterface;
use Era269\Microobject\MicroobjectInterface;
use Era269\Microobject\RouterAwareInterface;
use Era269\Microobject\RouterInterface;

trait RouterAwareTrait
{
    private RouterInterface $router;

    final public function withRouter(RouterInterface $router): void
    {
        if (isset($this->router)) {
            $this->router->fill($router);
        }
        $this->router = $router;
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function send(MessageInterface $message): ReplyInterface
    {
        return $this->router->send($message);
    }

    final protected function attachToRouter(RouterAwareInterface $routerAware): void
    {
        $routerAware->withRouter($this->router);
    }

    final protected function detachFromRouter(MicroobjectInterface $microobject): void
    {
        $this->router->detach($microobject);
    }
}
