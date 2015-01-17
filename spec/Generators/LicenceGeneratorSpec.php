<?php

namespace spec\Packedge\Workbench\Generators;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LicenceGeneratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Packedge\Workbench\Generators\LicenceGenerator');
    }

    /** @test */
    public function it_builds_a_human_readable_list_of_licences()
    {
        $this->showList()->shouldReturn([
            'MIT' => 'MIT',
            'Apache 2.0' => 'Apache-2.0',
            'GNU GPL v3.0' => 'GPL-3',
        ]);
    }
}
