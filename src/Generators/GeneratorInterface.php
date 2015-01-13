<?php namespace Packedge\Workbench\Generators;


interface GeneratorInterface
{
    /**
     * Creates the required files for the generator.
     *
     * @return void
     */
    public function create($packagePath);

    /**
     * Provides an array of directories to be made in the package directory.
     *
     * @return array
     */
    public function getDirectories();

} 