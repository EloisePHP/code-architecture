<?php

namespace Eloise\Architecture\Tests\Fixtures;

use Eloise\Architecture\Tests\Fixtures\Interfaces\FixturesInterface;
use Eloise\Architecture\Tests\Fixtures\Interfaces\SecondFixturesInterface;

class TwoClassesInside implements FixturesInterface, SecondFixturesInterface
{
    public function method(): void
    {
    }
}

class SecondClassInside extends AbstractClass
{
}
