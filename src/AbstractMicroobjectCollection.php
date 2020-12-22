<?php

declare(strict_types=1);

namespace Era269\Microobject;

use Era269\Microobject\Exception\ExceptionInterface;
use Era269\Microobject\Identifier\IdentifierCollection;
use Era269\Microobject\Message\ReplyInterface;
use Era269\Microobject\Traits\IdentifierCollectionAwareTrait;

abstract class AbstractMicroobjectCollection extends AbstractMicroobject
{
    use IdentifierCollectionAwareTrait;

    private ?MicroobjectInterface $current = null;

    public function __construct(IdentifierInterface ...$ids)
    {
        parent::__construct();
        $this->withIdentifierCollection(new IdentifierCollection(...$ids));
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function attach(MicroobjectInterface $microobject): void
    {
        $this->getRepository()->attach($microobject);
        $this->attachToRouter($microobject);
        $this->getIdentifierCollection()->attach(
            $microobject->getId()
        );
        // ToDo: maybe not necessary
        $this->setCurrent($microobject);
    }

    abstract protected function getRepository(): RepositoryInterface;

    final protected function setCurrent(MicroobjectInterface $microobject): void
    {
        // ToDo: maybe can be removed because we call $collectionItem->process directly
        $this->unsetCurrent();

        $this->current = $microobject;
        $this->attachToRouter($this->current);
    }

    final protected function unsetCurrent(): void
    {
        if (!is_null($this->current)) {
            $this->detachFromRouter($this->current);
        }
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function detach(IdentifierInterface $id): void
    {
        $microobject = $this->getOffset($id);
        $this->getRepository()->detach($microobject);
        $this->detachFromRouter($microobject);
        $this->getIdentifierCollection()->detach(
            $id
        );
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function getOffset(IdentifierInterface $id): MicroobjectInterface
    {
        return $this->getRepository()->get($id);
    }

    /**
     * @throws ExceptionInterface
     */
    final protected function processCollectionItemMessage(MessageInterface $message, MicroobjectInterface $collectionItem): ReplyInterface
    {
        $this->setCurrent(
            $collectionItem
        );
        return $collectionItem->process($message);
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
