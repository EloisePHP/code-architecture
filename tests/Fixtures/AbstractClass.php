<?php

namespace Eloise\Architecture\Tests\Fixtures;

use Eloise\Architecture\Tests\Fixtures\Interfaces\FixturesInterface as InterfaceName;

abstract class AbstractClass implements InterfaceName
{
    public function method(): void
    {
    }
}