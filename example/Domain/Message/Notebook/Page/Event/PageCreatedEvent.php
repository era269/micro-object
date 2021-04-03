<?php
declare(strict_types=1);


namespace Era269\Microobject\Example\Domain\Message\Notebook\Page\Event;


use Era269\Microobject\Example\Domain\Message\Notebook\Page\AbstractPageMessage;
use Era269\Microobject\Example\Domain\Message\Notebook\Page\Command\CreatePageCommand;
use Era269\Microobject\Example\Domain\Notebook\Page\Text;
use Era269\Microobject\IdentifierInterface;
use Era269\Microobject\Message\EventInterface;

final class PageCreatedEvent extends AbstractPageMessage implements EventInterface
{
    private Text $text;

    public function __construct(
        CreatePageCommand $command
    )
    {
        parent::__construct($command->getNotebookId(), $command->getPageId());
        $this->text = $command->getText();
    }

    public function getDomainModelId(): IdentifierInterface
    {
        return $this->getPageId();
    }

    public function getText(): Text
    {
        return $this->text;
    }

    protected function getNormalized(): array
    {
        return parent::getNormalized() + [
                'text' => $this->text->normalize()
            ];
    }
}
