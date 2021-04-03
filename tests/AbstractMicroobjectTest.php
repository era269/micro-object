<?php
declare(strict_types=1);

namespace Tests\Era269\Microobject;

use Era269\Microobject\AbstractMicroobject;
use PHPUnit\Framework\TestCase;

class AbstractMicroobjectTest extends TestCase
{

    public function test__construct()
    {
        /** @var AbstractMicroobject $mo */
        $mo = $this->getMockForAbstractClass(AbstractMicroobject::class);

    }
}
