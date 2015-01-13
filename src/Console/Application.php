<?php namespace Packedge\Workbench\Console;

use Illuminate\Container\Container;

class Application extends \Symfony\Component\Console\Application
{
    protected $container;

    public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        parent::__construct($name, $version);
        $this->container = new Container;
    }

    public function resolve($commandName)
    {
        $class = $this->container->make($commandName);

        $this->add($class);
    }
} 