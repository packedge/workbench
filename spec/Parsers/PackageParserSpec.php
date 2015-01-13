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
        $this->parse('example-vendor/project')->toDirectoryName()->shouldReturn('example-vendor-project');
        $this->parse('example/project-name')->toDirectoryName()->shouldReturn('example-project-name');
        $this->parse('example-vendor/project-name')->toDirectoryName()->shouldReturn('example-vendor-project-name');
    }

    /** @test */
    public function it_parses_a_package_name_into_a_psr4_namespace()
    {
        $this->parse('example/project')->toPsr4()->shouldReturn('Example\\\\Project');
    }

    /** @test */
    public function it_parses_a_package_name_into_a_human_readable_name()
    {
        $this->parse('example/project')->toHuman()->shouldReturn('Project');
        $this->parse('example/project-name')->toHuman()->shouldReturn('Project Name');
    }
}
