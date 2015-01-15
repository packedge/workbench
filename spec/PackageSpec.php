<?php

namespace spec\Packedge\Workbench;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PackageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Packedge\Workbench\Package');
    }

    /** @test */
    public function it_sets_and_gets_the_package_name()
    {
        $pkg = 'package-name';
        $this->setPackageName($pkg);
        $this->getPackageName()->shouldReturn($pkg);
    }
}
