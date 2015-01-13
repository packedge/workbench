<?php

namespace spec\Packedge\Workbench\Console\Package;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NewCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Packedge\Workbench\Console\Package\NewCommand');
    }
}
