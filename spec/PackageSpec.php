<?php

namespace spec\Packedge\Workbench;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PackageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Packedge\Workbench\Package');
    }
}
