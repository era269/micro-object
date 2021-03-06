<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Application\Port;

use Era269\Microobject\Example\Domain\Message\Notebook\Command\CreateNotebookCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\AddLineCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\CreatePageCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Query\GetPageQuery;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Query\GetTextQuery;
use Era269\Microobject\Example\Domain\Message\Notebook\Query\GetNotebookQuery;
use Era269\Microobject\Example\Domain\Notebook\NotebookCollectionFactory;
use Era269\Microobject\Exception\MicroobjectExceptionInterface;

final class NotebooksPort
{
    private NotebookCollectionFactory $notebookCollectionFactory;

    public function __construct(NotebookCollectionFactory $notebookCollectionFactory)
    {
        $this->notebookCollectionFactory = $notebookCollectionFactory;
    }

    /**
     * POST /notebooks
     *
     * @param array<string, mixed> $request
     *
     * @return array<string, mixed>
     *
     * @throws MicroobjectExceptionInterface
     */
    public function addNotebook(array $request): array
    {
        return $this->notebookCollectionFactory
            ->create()
            ->process(
                CreateNotebookCommand::denormalize($request)
            )
            ->normalize();
    }

    /**
     * POST /notebooks/{notebookId}/pages
     *
     * @param array<string, mixed> $request
     *
     * @return array<string, mixed>
     *
     * @throws MicroobjectExceptionInterface
     */
    public function addPage(array $request): array
    {
        return $this->notebookCollectionFactory
            ->create()
            ->process(
                CreatePageCommand::denormalize($request)
            )
            ->normalize();
    }

    /**
     * POST /notebooks/{notebookId}/pages/{pageId}/text/add-line
     *
     * @param array<string, mixed> $request
     *
     * @return array<string, mixed>
     *
     * @throws MicroobjectExceptionInterface
     */
    public function addLine(array $request): array
    {
        return $this->notebookCollectionFactory
            ->create()
            ->process(
                AddLineCommand::denormalize($request)
            )
            ->normalize();
    }

    /**
     * GET /notebooks/{notebookId}/pages/{pageId}/text
     *
     * @param array<string, mixed> $request
     *
     * @return array<string, mixed>
     *
     * @throws MicroobjectExceptionInterface
     */
    public function getText(array $request): array
    {
        return $this->notebookCollectionFactory
            ->create()
            ->process(
                GetTextQuery::denormalize($request)
            )
            ->normalize();
    }

    /**
     * GET /notebooks/{notebookId}/pages/{pageId}
     *
     * @param array<string, mixed> $request
     *
     * @return array<string, mixed>
     *
     * @throws MicroobjectExceptionInterface
     */
    public function getPage(array $request): array
    {
        return $this->notebookCollectionFactory
            ->create()
            ->process(
                GetPageQuery::denormalize($request)
            )
            ->normalize();
    }

    /**
     * GET /notebooks/{notebookId}
     *
     * @param array<string, mixed> $request
     *
     * @return array<string, mixed>
     *
     * @throws MicroobjectExceptionInterface
     */
    public function getNotebook(array $request): array
    {
        return $this->notebookCollectionFactory
            ->create()
            ->process(
                GetNotebookQuery::denormalize($request)
            )
            ->normalize();
    }
}
