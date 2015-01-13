<?php

namespace spec\Packedge\Workbench\Parsers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PackageParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Packedge\Workbench\Parsers\PackageParser');
    }

    /** @test */
    public function it_parses_a_package_name_into_a_directory_name()
    {
        $this->parse('example/project')->toDirectoryName()->shouldReturn('example-project');
    }

    /** @test */
    public function it_parses_a_package_name_into_a_psr4_namespace()
    {
        $this->parse('example/project')->toPsr4()->shouldReturn('Example\\\\Project');
    }
}
