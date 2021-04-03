<?php
declare(strict_types=1);

namespace Era269\Microobject\Example\Domain\Message\Notebook\Page;

use Era269\Microobject\Example\Domain\Notebook\Page\PageIdAwareInterface;

interface PageMessageInterface extends PageCollectionMessageInterface, PageIdAwareInterface
{

}
