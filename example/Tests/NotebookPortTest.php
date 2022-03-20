<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Tests;

use Era269\Microobject\Example\Application\Port\NotebooksPort;
use Era269\Microobject\Example\Domain\Message\Notebook\Event\NotebookCreatedEvent;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Event\LineAddedEvent;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Event\PageCreatedEvent;
use Era269\Microobject\Example\Domain\Notebook;
use Era269\Microobject\Example\Domain\Notebook\NotebookCollectionFactory;
use Era269\Microobject\Example\Domain\Notebook\Page\PageFactory;
use Era269\Microobject\Example\Domain\Notebook\PageCollection;
use Era269\Microobject\Example\Infrastructure\EventStorage;
use Era269\Microobject\Example\Infrastructure\Listener\PersistenceListener;
use Era269\Microobject\Example\Infrastructure\Repository\NotebookRepository;
use Era269\Microobject\Example\Infrastructure\Repository\PageRepository;
use Era269\Microobject\Exception\MicroobjectExceptionInterface;
use Era269\Microobject\Exception\MicroobjectOutOfBoundsException;
use Era269\Microobject\Message\Event\EventStorageInterface;
use Era269\Normalizable\KeyDecorator\AsIsKeyDecorator;
use Era269\Normalizable\KeyDecoratorInterface;
use Era269\Normalizable\Normalizer\ArrayNormalizer;
use Era269\Normalizable\Normalizer\FailNormalizer;
use Era269\Normalizable\Normalizer\ListNormalizableToNormalizableAdapterNormalizer;
use Era269\Normalizable\Normalizer\NormalizableNormalizer;
use Era269\Normalizable\Normalizer\NormalizationFacade;
use Era269\Normalizable\Normalizer\ScalarableNormalizer;
use Era269\Normalizable\Normalizer\ScalarNormalizer;
use Era269\Normalizable\Normalizer\StringableNormalizer;
use Era269\Normalizable\Normalizer\WithTypeNormalizableNormalizerDecorator;
use LogicException;
use PHPUnit\Framework\TestCase;

class NotebookPortTest extends TestCase
{
    private const UNIQUE_ID_NOTEBOOK     = 'notebook-unique-id';
    private const UNIQUE_ID_PAGE         = '1';
    private const WRONG_ID_PAGE          = '-1';

    private const NORMALIZED_PAYLOAD     = 'payload';
    private const NORMALIZED_ID          = 'id';
    private const NORMALIZED_VALUE       = 'value';
    private const NORMALIZED_OCCURRED_AT = 'occurredAt';
    private const NORMALIZED_NOTEBOOK_ID = 'notebookId';
    private const NORMALIZED_PAGE_ID     = 'pageId';
    private const NORMALIZED_LINES       = 'lines';
    private const NORMALIZED_LINE        = 'line';

    private TestEventDispatcher $eventDispatcher;

    public function testGetUnExistingNotebook(): void
    {
        $this->expectException(MicroobjectOutOfBoundsException::class);

        $this->getAutowiredNotebookPort(new EventStorage())
            ->getNotebook([
                'notebookId' => self::UNIQUE_ID_NOTEBOOK,
            ]);
    }

    private function getAutowiredNotebookPort(EventStorageInterface $eventStorage): NotebooksPort
    {
        return new NotebooksPort(
            $this->getAutowiredNotebookCollectionFactory($eventStorage),
            new NormalizationFacade(
                new AsIsKeyDecorator(),
                [
                    new ScalarNormalizer(),
                    new ArrayNormalizer(),
                    new ListNormalizableToNormalizableAdapterNormalizer(),
                    new WithTypeNormalizableNormalizerDecorator(
                        new NormalizableNormalizer()
                    ),
                    new ScalarableNormalizer(),
                    new StringableNormalizer(),
                    new FailNormalizer(),
                ]
            )
        );
    }

    private function getAutowiredNotebookCollectionFactory(EventStorageInterface $eventStorage): NotebookCollectionFactory
    {
        $this->eventDispatcher = new TestEventDispatcher(
            [
                new PersistenceListener(
                    $eventStorage
                ),
            ]);

        $pageFactory = new PageFactory(
            $this->eventDispatcher
        );
        $notebookFactory = new Notebook\NotebookFactory(
            $this->eventDispatcher,
            new PageCollection(
                new PageRepository($eventStorage, $pageFactory),
                $pageFactory
            )
        );

        return new NotebookCollectionFactory(
            new NotebookRepository($eventStorage, $notebookFactory),
            $notebookFactory
        );
    }

    public function testAddNotebook(): EventStorageInterface
    {
        $eventStorage = new EventStorage();

        $this->getAutowiredNotebookPort($eventStorage)
            ->addNotebook([
                'notebookId' => self::UNIQUE_ID_NOTEBOOK,
                'notebookName' => 'notebook-name',
            ]);

        $this->assertEventDispatched(NotebookCreatedEvent::class);

        return $eventStorage;
    }

    private function assertEventDispatched(string $eventClassName): void
    {
        self::assertArrayHasKey($eventClassName, $this->eventDispatcher->getDispatchedEvents());
    }

    /**
     * @depends testAddNotebook
     */
    public function testGetNotebook(EventStorageInterface $eventStorage): EventStorageInterface
    {
        $normalizedNotebookResponse = $this->getAutowiredNotebookPort($eventStorage)
            ->getNotebook([
                'notebookId' => self::UNIQUE_ID_NOTEBOOK,
            ]);

        self::assertEquals(
            self::UNIQUE_ID_NOTEBOOK,
            $normalizedNotebookResponse[self::NORMALIZED_PAYLOAD][self::NORMALIZED_ID][self::NORMALIZED_VALUE]
        );
        self::assertEquals('Notebook', $normalizedNotebookResponse[self::NORMALIZED_PAYLOAD]['@type']);

        return $eventStorage;
    }

    /**
     * @depends testGetNotebook
     */
    public function testAddPage(EventStorageInterface $eventStorage): EventStorageInterface
    {
        $this->getAutowiredNotebookPort($eventStorage)
            ->addPage([
                'notebookId' => self::UNIQUE_ID_NOTEBOOK,
                'pageId' => self::UNIQUE_ID_PAGE,
                'text' => [
                    'first line',
                    'second line',
                ],
            ]);

        $this->assertEventDispatched(PageCreatedEvent::class);

        return $eventStorage;
    }

    /**
     * @depends testAddPage
     */
    public function testGetPage(EventStorageInterface $eventStorage): EventStorageInterface
    {
        $normalizedPageResponse = $this->getAutowiredNotebookPort($eventStorage)
            ->getPage([
                'notebookId' => self::UNIQUE_ID_NOTEBOOK,
                'pageId' => self::UNIQUE_ID_PAGE,
            ]);

        self::assertEquals(
            self::UNIQUE_ID_PAGE,
            $normalizedPageResponse[self::NORMALIZED_PAYLOAD][self::NORMALIZED_ID][self::NORMALIZED_VALUE]
        );

        return $eventStorage;
    }

    /**
     * @depends testAddPage
     */
    public function testGetPageNotFound(EventStorageInterface $eventStorage): EventStorageInterface
    {
        $this->expectException(MicroobjectOutOfBoundsException::class);

        $normalizedPageResponse = $this->getAutowiredNotebookPort($eventStorage)
            ->getPage([
                'notebookId' => self::UNIQUE_ID_NOTEBOOK,
                'pageId' => self::WRONG_ID_PAGE,
            ]);

        self::assertEquals(
            self::UNIQUE_ID_PAGE,
            $normalizedPageResponse[self::NORMALIZED_PAYLOAD][self::NORMALIZED_ID][self::NORMALIZED_VALUE]
        );

        return $eventStorage;
    }

    /**
     * @depends testGetPage
     */
    public function testAddLine(EventStorageInterface $eventStorage): EventStorageInterface
    {
        $line = 'third line';
        $result = $this->getAutowiredNotebookPort($eventStorage)
            ->addLine([
                'notebookId' => self::UNIQUE_ID_NOTEBOOK,
                'pageId' => self::UNIQUE_ID_PAGE,
                'line' => $line,
            ]);

        $this->assertEventDispatched(LineAddedEvent::class);

        self::assertArrayHasKey(self::NORMALIZED_ID, $result);
        self::assertArrayHasKey(self::NORMALIZED_OCCURRED_AT, $result);

        self::assertEquals(
            'LineAddedEvent',
            $result['@type']
        );
        self::assertEquals(
            $line,
            $result[self::NORMALIZED_LINE]
        );
        self::assertEquals(
            self::UNIQUE_ID_NOTEBOOK,
            $result[self::NORMALIZED_NOTEBOOK_ID][self::NORMALIZED_VALUE]
        );
        self::assertEquals(
            self::UNIQUE_ID_PAGE,
            $result[self::NORMALIZED_PAGE_ID][self::NORMALIZED_VALUE]
        );

        return $eventStorage;
    }

    /**
     * @depends testAddLine
     */
    public function testGetText(EventStorageInterface $eventStorage): void
    {
        $normalizedTextResponse = $this->getAutowiredNotebookPort($eventStorage)
            ->getText([
                'notebookId' => self::UNIQUE_ID_NOTEBOOK,
                'pageId' => self::UNIQUE_ID_PAGE,
            ]);

        $expectedText = [
            'first line',
            'second line',
            'third line',
        ];

        self::assertEquals(
            $expectedText,
            $normalizedTextResponse[self::NORMALIZED_PAYLOAD][self::NORMALIZED_LINES]
        );
    }

    /**
     * @depends testAddPage
     */
    public function testWrongMessageProcessingCase(EventStorageInterface $eventStorage): void
    {
        $this->expectException(LogicException::class);

        $this->getAutowiredNotebookCollectionFactory($eventStorage)
            ->create()
            ->process(new TestFailPageEvent(
                new Notebook\NotebookId(self::UNIQUE_ID_NOTEBOOK),
                new Notebook\Page\PageId(self::UNIQUE_ID_PAGE),
            ));
    }
}
