<?php namespace Packedge\Workbench\Listeners;

use Packedge\Workbench\Foundation\EventListener;
use Packedge\Workbench\Package;

class NewPackageListener extends EventListener
{
    public function handle(Package $package)
    {
        var_dump('new package.....');
        var_dump($package->getPackageName());
        die();
    }


} 