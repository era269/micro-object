<?php
declare(strict_types=1);

namespace Era269\Example\Tests;

use Era269\Example\Domain\Message\Notebook\Command\AttachNotebookCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\Command\AttachPageCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Command\AttachLineCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Query\GetLineQuery;
use Era269\Example\Domain\Message\Notebook\Page\Line\Reply\LineCollectionReply;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\AttachWordCollectionCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\CreateWordCommand;
use Era269\Example\Domain\Message\Notebook\Page\Line\Word\Command\RevertWordCommand;
use Era269\Example\Domain\Notebook;
use Era269\Example\Domain\Notebook\NotebookId;
use Era269\Example\Domain\Notebook\Page;
use Era269\Example\Domain\Notebook\Page\Line;
use Era269\Example\Domain\Notebook\Page\Line\LineId;
use Era269\Example\Domain\Notebook\Page\Line\LineRepositoryInterface;
use Era269\Example\Domain\Notebook\Page\Line\Word;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordId;
use Era269\Example\Domain\Notebook\Page\Line\Word\WordRepositoryInterface;
use Era269\Example\Domain\Notebook\Page\Line\WordCollection;
use Era269\Example\Domain\Notebook\Page\LineCollection;
use Era269\Example\Domain\Notebook\Page\PageId;
use Era269\Example\Domain\Notebook\Page\PageRepositoryInterface;
use Era269\Example\Domain\Notebook\PageCollection;
use Era269\Example\Infrastructure\Factory\NotebookCollectionFactory;
use Era269\Example\Infrastructure\Repository\LineRepository;
use Era269\Example\Infrastructure\Repository\NotebookRepository;
use Era269\Example\Infrastructure\Repository\PageRepository;
use Era269\Example\Infrastructure\Repository\WordRepository;
use PHPUnit\Framework\TestCase;

class WordTest extends TestCase
{
    const UNIQUE_ID_NOTEBOOK = 'notebook-unique-id';
    const UNIQUE_ID_PAGE     = 'page-unique-id';
    const UNIQUE_ID_LINE     = 'line-unique-id';
    const UNIQUE_ID_WORD     = 'word-unique-id';
    private NotebookCollectionFactory $notebookCollectionFactory;
//    private MockObject|PageRepositoryInterface $pageRepository;
//    private LineRepositoryInterface|MockObject $lineRepository;
//    private WordRepositoryInterface|MockObject $wordRepository;
    private PageRepositoryInterface $pageRepository;
    private LineRepositoryInterface $lineRepository;
    private WordRepositoryInterface $wordRepository;
    private NotebookId $notebookId;
    private PageId $pageId;
    private LineId $lineId;

    public function test(): void
    {
        $notebooks = $this->notebookCollectionFactory->create();
        $notebooks->attachNotebook(
            new AttachNotebookCollectionCommand(
                new Notebook(
                    $this->notebookId,
                    'Dairy',
                    PageCollection::create(
                        $this->pageRepository
                    )
                )
            )
        );
        $notebooks->process(
            new AttachPageCollectionCommand(
                $this->notebookId,
                new Page(
                    $this->pageId,
                    LineCollection::create(
                        $this->lineRepository
                    )
                )
            )
        );
        $notebooks->process(
            new AttachLineCollectionCommand(
                $this->notebookId,
                $this->pageId,
                new Line(
                    $this->lineId,
                    WordCollection::create(
                        $this->wordRepository
                    )
                )
            )
        );
        $notebooks->process(
            $this->createAttachWordCollectionCommand(self::UNIQUE_ID_WORD, 'Hello')
        );
        $notebooks->process(
            $this->createAttachWordCollectionCommand(' ', ' ')
        );
        $notebooks->process(
            $this->createAttachWordCollectionCommand('World', 'World')
        );
        $notebooks->process(
            $this->createAttachWordCollectionCommand('!', '!')
        );
        $notebooks->process(
            new RevertWordCommand(
                $this->notebookId,
                $this->pageId,
                $this->lineId,
                WordId::denormalize(self::UNIQUE_ID_WORD)
            )
        );
        /** @var LineCollectionReply $result */
        $result = $notebooks->process(
            new GetLineQuery(
                $this->notebookId,
                $this->pageId,
                $this->lineId
            )
        );
        self::assertInstanceOf(LineCollectionReply::class, $result);
        var_dump($result->normalize());
    }

    private function createAttachWordCollectionCommand(string $id, string $word): AttachWordCollectionCommand
    {
        return new AttachWordCollectionCommand(
            $this->notebookId,
            $this->pageId,
            $this->lineId,
            Word::create(
                new CreateWordCommand(
                    $this->notebookId,
                    $this->pageId,
                    $this->lineId,
                    WordId::denormalize($id),
                    $word
                ),
            )
        );
    }

    protected function setUp(): void
    {
        parent::setUp();
        $notebookRepository = new NotebookRepository();
        $this->pageRepository = new PageRepository();
        $this->lineRepository = new LineRepository();
        $this->wordRepository = new WordRepository();
//        $this->notebookRepository = self::createMock(NotebookRepositoryInterface::class);
//        $this->pageRepository = self::createMock(PageRepositoryInterface::class);
//        $this->lineRepository = self::createMock(LineRepositoryInterface::class);
//        $this->wordRepository = self::createMock(WordRepositoryInterface::class);

        $this->notebookCollectionFactory = new NotebookCollectionFactory(
            $notebookRepository
        );
        $this->notebookId = NotebookId::denormalize(self::UNIQUE_ID_NOTEBOOK);
        $this->pageId = PageId::denormalize(self::UNIQUE_ID_PAGE);
        $this->lineId = LineId::denormalize(self::UNIQUE_ID_LINE);
    }
}
