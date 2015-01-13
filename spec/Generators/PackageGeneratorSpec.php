<?php

namespace spec\Packedge\Workbench\Generators;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PackageGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Packedge\Workbench\Generators\PackageGenerator');
    }
}
