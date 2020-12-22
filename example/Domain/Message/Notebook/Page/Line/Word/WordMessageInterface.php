<?php
declare(strict_types=1);

namespace Era269\Example\Domain\Message\Notebook\Page\Line\Word;

use Era269\Example\Domain\Notebook\Page\Line\Word\WordIdAwareInterface;

interface WordMessageInterface extends WordCollectionMessageInterface, WordIdAwareInterface
{

}
