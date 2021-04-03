<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain\Message;


use Era269\Microobject\Example\Domain\Identifier\AutogeneratedIdentifier;
use Era269\Microobject\Message\MessageIdInterface;

final class MessageId extends AutogeneratedIdentifier implements MessageIdInterface
{

}
