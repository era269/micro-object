<?php

declare(strict_types=1);

namespace Era269\TrueObject\Traits;

use Era269\TrueObject\Exception\DomainException;
use Era269\TrueObject\Exception\ExceptionInterface;
use Era269\TrueObject\Message\Command\DoCommandInterface;
use Era269\TrueObject\Message\Command\ResultInterface;
use Era269\TrueObject\Message\CommandInterface;
use Era269\TrueObject\Subjects;

trait CanDoCommandTrait
{
    /**
     * @var Subjects&DoCommandInterface[]
     */
    private Subjects $subjects;

    /**
     * @throws ExceptionInterface
     */
    public function do(CommandInterface $command)
    : ResultInterface
    {
        return $this->tryToDoByOwnOrDelegateToSubjects(
            $this->buildMethodName('do%s', $command),
            $command
        );
    }

    /**
     * @throws ExceptionInterface
     */
    private function tryToDoByOwnOrDelegateToSubjects(string $methodName, CommandInterface $command)
    : ResultInterface
    {
        return method_exists($this, $methodName)
            ? $this->$methodName($command)
            : $this->delegateDoingToSubjects($command);
    }

    /**
     * @throws ExceptionInterface
     */
    private function delegateDoingToSubjects(CommandInterface $command)
    : ResultInterface
    {
        foreach ($this->subjects as $subject) {
            try {
                return $subject->do($command);
            } catch (ExceptionInterface $exception) {
                continue;
            }
        }
        throw new DomainException(sprintf(
            'Unknown command "%s"',
            get_class($command)
        ));
    }
}
