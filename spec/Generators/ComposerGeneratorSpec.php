<?php

namespace spec\Packedge\Workbench\Generators;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ComposerGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Packedge\Workbench\Generators\BaseGenerator');
        $this->shouldHaveType('Packedge\Workbench\Generators\GeneratorInterface');
        $this->shouldHaveType('Packedge\Workbench\Generators\ComposerGenerator');
    }
}
