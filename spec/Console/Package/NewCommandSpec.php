<?php

namespace spec\Packedge\Workbench\Console\Package;

use Packedge\Workbench\Foundation\EventManager;
use Packedge\Workbench\Package;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NewCommandSpec extends ObjectBehavior
{
    public function let(EventManager $manager, Package $package)
    {
        $this->beConstructedWith($manager, $package);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Packedge\Workbench\Console\Package\NewCommand');
    }
}
