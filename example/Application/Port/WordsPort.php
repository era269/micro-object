<?php
declare(strict_types=1);

namespace Era269\Example\Application\Port;

use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\AddWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\RemoveWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\RevertWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Query\GetWordQuery;
use Era269\Example\Infrastructure\Factory\NotebookCollectionFactory;
use Era269\Microobject\Exception\ExceptionInterface;

final class WordsPort
{
    private NotebookCollectionFactory $notebookCollectionFactory;

    public function __construct(NotebookCollectionFactory $notebookCollectionFactory)
    {
        $this->notebookCollectionFactory = $notebookCollectionFactory;
    }

    /**
     * PUT /notebooks/{notebookId}/pages/{pageId}/lines/{lineId}/word
     * @throws ExceptionInterface
     */
    public function putWord(array $request): array
    {
        return $this->notebookCollectionFactory
            ->restore()
            ->process(
                AddWordCommand::denormalize($request)
            )
            ->normalize();
    }

    /**
     * GET /notebooks/{notebookId}/pages/{pageId}/lines/{lineId}/words/{wordId}
     * @throws ExceptionInterface
     */
    public function getWord(array $request): array
    {
        return $this->notebookCollectionFactory
            ->restore()
            ->process(
                GetWordQuery::denormalize($request)
            )
            ->normalize();
    }

    /**
     * DELETE /notebooks/{notebookId}/pages/{pageId}/lines/{lineId}/words/{wordId}
     * @throws ExceptionInterface
     */
    public function deleteWord(array $request): array
    {
        return $this->notebookCollectionFactory
            ->restore()
            ->process(
                RemoveWordCommand::denormalize($request)
            )
            ->normalize();
    }

    /**
     * POST /notebooks/{notebookId}/pages/{pageId}/lines/{lineId}/words/{wordId}/revert
     * @throws ExceptionInterface
     */
    public function revertWord(array $request): array
    {
        return $this->notebookCollectionFactory
            ->restore()
            ->process(
                RevertWordCommand::denormalize($request)
            )
            ->normalize();
    }
}
