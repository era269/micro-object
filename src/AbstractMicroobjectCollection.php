<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Identifier\IdentifierCollection;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\Traits\IdentifierCollectionAwareTrait;
use Traversable;

abstract class AbstractMicroobjectCollection extends AbstractMicroobject implements CollectionInterface
{
    use IdentifierCollectionAwareTrait;

    private ?MicroobjectInterface $current = null;

    public function __construct(IdentifierInterface ...$ids)
    {
        parent::__construct();
        $this->withIdentifierCollection(new IdentifierCollection(...$ids));
    }

    public function count(): int
    {
        return $this->getRepository()->count();
    }

    abstract protected function getRepository(): RepositoryInterface;

    public function getIterator(): Traversable
    {
        return $this->getIdentifierCollection();
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function attach(MicroobjectInterface $microobject = null): void
    {
        $this->getRepository()->attach($microobject);
        $this->attachToRouter($microobject);
        // ToDo: maybe not necessary
        $this->setCurrent($microobject);
    }

    final protected function setCurrent(MicroobjectInterface $microobject): void
    {
        $this->unsetCurrent();
        $this->current = $microobject;
    }

    final protected function unsetCurrent(): void
    {
        if (!is_null($this->current)) {
            $this->detachFromRouter($this->current);
        }
    }

    final protected function attachIdentifier(IdentifierInterface $identifier): void
    {
        $this->getIdentifierCollection()->attach(
            $identifier
        );
    }

    final protected function detachIdentifier(IdentifierInterface $identifier): void
    {
        $this->getIdentifierCollection()->detach(
            $identifier
        );
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function detach(MicroobjectInterface $microobject): void
    {
        $this->getRepository()->detach($microobject);
        $this->detachFromRouter($microobject);
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function processCollectionItemMessage(MessageInterface $message, IdentifierInterface $identifier): ReplyInterface
    {
        $microobject = $this->getOffset($identifier);
        $this->setCurrent(
            $microobject
        );
        return $microobject->process($message);
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function getOffset(IdentifierInterface $id): MicroobjectInterface
    {
        return $this->getRepository()->get($id);
    }

    protected function getNormalized(): array
    {
        return [
            'id' => $this->getId()->normalize(),
            'items' => $this->getIdentifierCollection()->normalize(),
        ];
    }

    abstract public function getId(): IdentifierInterface;


}
