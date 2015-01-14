<?php namespace Packedge\Workbench\Generators;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;

class ComposerGenerator extends BaseGenerator implements GeneratorInterface
{
    /**
     * @param Filesystem $filesystem
     * @param Mustache_Engine $mustache
     */
    public function __construct(Filesystem $filesystem = null, Mustache_Engine $mustache = null)
    {
        parent::__construct($filesystem, $mustache);
        $this->templatePath = __DIR__ . '/../../templates/composer.txt';
        $this->outputPath = 'composer.json';
    }
}