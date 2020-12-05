<?php

declare(strict_types=1);

namespace Era269\TrueObject\Traits;

use Era269\TrueObject\Exception\DomainException;
use Era269\TrueObject\Exception\ExceptionInterface;
use Era269\TrueObject\Message\Request\HandleRequestInterface;
use Era269\TrueObject\Message\RequestInterface;
use Era269\TrueObject\Message\Request\ResponseInterface;
use Era269\TrueObject\Subjects;

trait CanHandleRequestTrait
{
    use CanBuildMethodNameByFormat;

    /**
     * @var Subjects&HandleRequestInterface[]
     */
    private Subjects $subjects;

    /**
     * @throws ExceptionInterface
     */
    public function handle(RequestInterface $request)
    : ResponseInterface
    {
        return $this->tryToHandleByOwnOrDelegateToSubjects(
            $this->buildMethodName('handle%s', $request),
            $request
        );
    }

    /**
     * @throws ExceptionInterface
     */
    private function tryToHandleByOwnOrDelegateToSubjects(string $methodName, RequestInterface $request): ResponseInterface
    {
        return method_exists($this, $methodName)
            ? $this->$methodName($request)
            : $this->delegateHandlingToSubjects($request);
    }

    /**
     * @throws ExceptionInterface
     */
    private function delegateHandlingToSubjects(RequestInterface $request)
    : ResponseInterface
    {
        foreach ($this->subjects as $subject) {
            try {
                return $subject->handle($request);
            } catch (ExceptionInterface $exception) {
                continue;
            }
        }
        throw new DomainException(sprintf(
            'Unknown request "%s"',
            get_class($request)
        ));
    }
}
