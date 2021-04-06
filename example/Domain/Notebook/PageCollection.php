<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Notebook;

use Era269\Microobject\AbstractMicroobjectCollection;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\CreatePageCommand;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\PageFactoryInterface;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\PageMessageInterface;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Query\GetPageQuery;
use Era269\Microobject\Example\Domain\Notebook\Page\PageRepositoryInterface;
use Era269\Microobject\Message\Response\BaseResponse;
use Era269\Microobject\Message\Response\PositiveEmptyResponse;
use Era269\Microobject\MessageInterface;

final class PageCollection extends AbstractMicroobjectCollection implements PageCollectionInterface
{
    public function __construct(
        private PageRepositoryInterface $repository,
        private PageFactoryInterface $pageFactory,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getPage(GetPageQuery $query): MessageInterface
    {
        return new BaseResponse(
            $this->repository->get(
                $query->getPageId()
            )
        );
    }

    public function attachPage(CreatePageCommand $command): MessageInterface
    {
        $this->pageFactory->createPage(
            $command
        );
        return new PositiveEmptyResponse();
    }

    public function processPageMessages(PageMessageInterface $message): MessageInterface
    {
        return $this->repository->get($message->getPageId())
            ->process($message);
    }
}
