<?php

namespace spec\Packedge\Workbench\Generators;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReadmeGeneratorSpec extends ObjectBehavior
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
        $this->shouldHaveType('Packedge\Workbench\Generators\ReadmeGenerator');
    }

    /** @test */
    public function it_creates_the_file()
    {
        $generatorPath = realpath(__DIR__ . '/../../templates/') . '/';

        $this->filesystem->get($generatorPath . 'readme.txt')->willReturn('template-data');
        $this->mustache->render('template-data', ['some' => 'value'])->willReturn('generated-output');
        $this->filesystem->put('file-path/README.md', 'generated-output')->shouldBeCalled();

        $this->setData(['some' => 'value']);
        $this->create('file-path');
    }

    /** @test */
    public function it_does_not_create_directories()
    {
        $this->getDirectories()->shouldReturn([]);
    }
}
