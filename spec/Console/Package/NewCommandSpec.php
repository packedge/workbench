<?php

namespace spec\Packedge\Workbench\Console\Package;

use Illuminate\Filesystem\Filesystem;
use Packedge\Workbench\Package;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NewCommandSpec extends ObjectBehavior
{
    public function let(Filesystem $filesystem, Package $package)
    {
        $this->beConstructedWith($filesystem, $package);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Packedge\Workbench\Console\Package\NewCommand');
    }
}
