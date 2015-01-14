<?php namespace Packedge\Workbench\Generators;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;

class ReadmeGenerator extends BaseGenerator implements GeneratorInterface
{
    public function __construct(Filesystem $filesystem = null, Mustache_Engine $mustache = null)
    {
        parent::__construct($filesystem, $mustache);
        $this->templatePath = __DIR__ . '/../../templates/readme.txt';
        $this->outputPath = 'README.md';
    }
}