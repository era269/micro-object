# true-object
OOP


## Examples

### Decorators

#### EventDispatcherDecorator
```php
<?php

declare(strict_types=1);

namespace Era269\TrueObject\TrueObjectEventDispatcherDecorator;

final class TrueObjectEventDispatcherDecorator extends \Era269\TrueObject\AbstractObject
{
    private \Psr\EventDispatcher\EventDispatcherInterface $eventDispatcher;

    public function __construct(\Era269\TrueObject\TrueObjectInterface $trueObject, \Psr\EventDispatcher\EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($trueObject);

        $this->eventDispatcher = $eventDispatcher;
    }

    public function notifyMe(\Era269\TrueObject\Message\EventInterface ...$events)
    : void
    {
        foreach($events as $event) {
            $this->eventDispatcher->dispatch($event);
        }   
        parent::notifyMe(...$events);
    }

    public function do(\Era269\TrueObject\Message\CommandInterface $command)
    : \Era269\TrueObject\Message\Command\ResultInterface
    {
        $this->eventDispatcher->dispatch($command);
        return parent::do($command);
    }

    public function handle(\Era269\TrueObject\Message\RequestInterface $request)
    : \Era269\TrueObject\Message\Request\ResponseInterface
    {
        $this->eventDispatcher->dispatch($request);
        return parent::handle($request);
    }

}

```
#### LoggerDecorator
It is better to dispatch events with `TrueObjectEventDispatcherDecorator` and use them for any infrastructure needs like logging.
However, it is simple to create a specific Logging Decorator:
```php
<?php

declare(strict_types=1);

namespace Era269\TrueObject\TrueObjectEventDispatcherDecorator;

final class TrueObjectLoggerDecorator extends \Era269\TrueObject\AbstractObject
{
    private const LOG_LEVEL = 'info';    
    private const LOG_MESSAGE_EVENT = 'Event';    
    private const LOG_MESSAGE_COMMAND = 'Command';    
    private const LOG_MESSAGE_QUERY = 'Query';    

    private \Psr\Log\LoggerInterface $logger;

    public function __construct(\Era269\TrueObject\TrueObjectInterface $trueObject, \Psr\Log\LoggerInterface $logger)
    {
        parent::__construct($trueObject);

        $this->logger = $logger;
    }

    public function notifyMe(\Era269\TrueObject\Message\EventInterface ...$events)
    : void
    {
        foreach($events as $event) {
            $this->logger->log(self::LOG_LEVEL, self::LOG_MESSAGE_EVENT, $event->normalize());
        }   
        parent::notifyMe(...$events);
    }
}

```
