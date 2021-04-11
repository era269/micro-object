<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain;

use Era269\Microobject\AbstractMicroobjectCollection;
use Era269\Microobject\Example\Domain\Message\Notebook\Command\CreateNotebookCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\NotebookMessageInterface;
use Era269\Microobject\Example\Domain\Message\Notebook\Query\GetNotebookQuery;
use Era269\Microobject\Example\Domain\Notebook\NotebookFactoryInterface;
use Era269\Microobject\Example\Domain\Notebook\NotebookRepositoryInterface;
use Era269\Microobject\Message\Response\BaseResponse;
use Era269\Microobject\Message\Response\NullResponse;
use Era269\Microobject\Message\ResponseInterface;

final class NotebookCollection extends AbstractMicroobjectCollection implements NotebookCollectionInterface
{
    private function __construct(
        private NotebookRepositoryInterface $notebookRepository,
        private NotebookFactoryInterface $notebookFactory,
    )
    {
    }

    public static function create(
        NotebookRepositoryInterface $repository,
        NotebookFactoryInterface $notebookFactory
    ): self
    {
        return self::restore($repository, $notebookFactory);
    }

    public static function restore(
        NotebookRepositoryInterface $repository,
        NotebookFactoryInterface $notebookFactory
    ): self
    {
        return new self(
            $repository,
            $notebookFactory
        );
    }

    /**
     * @inheritDoc
     */
    public function getNotebook(GetNotebookQuery $query): ResponseInterface
    {
        return new BaseResponse(
            $this->notebookRepository->get(
                $query->getNotebookId()
            )
        );
    }

    public function attachNotebook(CreateNotebookCommand $command): ResponseInterface
    {
        $this->notebookFactory->createNotebook(
            $command
        );

        return new NullResponse();
    }

    public function processNotebookMessage(NotebookMessageInterface $message): ResponseInterface
    {
        $notebook = $this->notebookRepository->get(
            $message->getNotebookId()
        );

        return $notebook->process($message);
    }
}
