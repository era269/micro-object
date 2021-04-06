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
use Era269\Microobject\Message\Event\EventStorageInterface;
use PHPUnit\Framework\TestCase;

class NotebookPortTest extends TestCase
{
    const UNIQUE_ID_NOTEBOOK = 'notebook-unique-id';
    const UNIQUE_ID_PAGE     = '1';
    private TestEventDispatcher $eventDispatcher;

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

    /**
     * @depends testAddNotebook
     */
    public function testGetNotebook(EventStorageInterface $eventStorage): EventStorageInterface
    {
        $normalizedNotebookResponse = $this->getAutowiredNotebookPort($eventStorage)
            ->getNotebook([
            'notebookId' => self::UNIQUE_ID_NOTEBOOK,
        ]);

        self::assertEquals(self::UNIQUE_ID_NOTEBOOK, $normalizedNotebookResponse['payload']['id']['value']);

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

        self::assertEquals(self::UNIQUE_ID_PAGE, $normalizedPageResponse['payload']['id']['value']);

        return $eventStorage;
    }

    /**
     * @depends testGetPage
     */
    public function testAddLine(EventStorageInterface $eventStorage): EventStorageInterface
    {
        $this->getAutowiredNotebookPort($eventStorage)
            ->addLine([
            'notebookId' => self::UNIQUE_ID_NOTEBOOK,
            'pageId' => self::UNIQUE_ID_PAGE,
            'line' => 'third line',
        ]);

        $this->assertEventDispatched(LineAddedEvent::class);

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
            'third line'
        ];

        self::assertEquals($expectedText, $normalizedTextResponse['payload']['lines']);
    }

    private function assertEventDispatched(string $eventClassName): void
    {
        self::assertArrayHasKey($eventClassName, $this->eventDispatcher->getDispatchedEvents());
    }

    private function getAutowiredNotebookPort(EventStorageInterface $eventStorage): NotebooksPort
    {
        $this->eventDispatcher = new TestEventDispatcher(
            [
                new PersistenceListener(
                    $eventStorage
                )
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
        return new NotebooksPort(
            new NotebookCollectionFactory(
                new NotebookRepository($eventStorage, $notebookFactory),
                $notebookFactory
            )
        );
    }
}
