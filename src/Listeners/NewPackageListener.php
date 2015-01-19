<?php namespace Packedge\Workbench\Listeners;

class NewPackageListener
{
    public function handle($data)
    {
        var_dump('new package.....');
        die();
    }
} 