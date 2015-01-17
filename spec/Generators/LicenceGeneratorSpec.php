<?php

namespace spec\Packedge\Workbench\Generators;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LicenceGeneratorSpec extends ObjectBehavior
{
    protected $filesystem;
    protected $mustache;

    public function let(Filesystem $filesystem, Mustache_Engine $mustache)
    {
        $this->filesystem = $filesystem;
        $this->mustache = $mustache;
        $this->beConstructedWith($filesystem, $mustache);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Packedge\Workbench\Generators\BaseGenerator');
        $this->shouldHaveType('Packedge\Workbench\Generators\GeneratorInterface');
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

    /** @test */
    public function it_throws_exception_for_invalid_licence_when_retrieving_name()
    {
        $this->shouldThrow('InvalidArgumentException')->during('getLicenceName', ['non-existant-licence']);
    }

    /** @test */
    public function it_gets_the_human_readable_licence_name_for_an_id()
    {
        $this->getLicenceName('GPL-3')->shouldReturn('GNU GPL v3.0');
    }

    /** @test */
    public function it_throws_exception_for_invalid_licence_when_setting_the_licence()
    {
        $this->shouldThrow('InvalidArgumentException')->during('setType', ['invalid']);
    }

    /** @test */
    public function it_creates_the_file()
    {
        $generatorPath = realpath(__DIR__ . '/../../templates/licences/') . '/';

        $this->filesystem->get($generatorPath . 'MIT.txt')->willReturn('template-data');
        $this->mustache->render('template-data', ['some' => 'value'])->willReturn('generated-output');
        $this->filesystem->put('file-path/LICENCE', 'generated-output')->shouldBeCalled();

        $this->setType('MIT');
        $this->setData(['some' => 'value']);
        $this->create('file-path');
    }

    /** @test */
    public function it_does_not_create_directories()
    {
        $this->getDirectories()->shouldReturn([]);
    }
}
