<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line;

use Era269\Example\Domain\Notebook\Page\Line\LineIdAwareInterface;

interface LineMessageInterface extends LineCollectionMessageInterface, LineIdAwareInterface
{

}
