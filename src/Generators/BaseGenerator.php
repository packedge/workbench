<?php namespace Packedge\Workbench\Generators;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;

class BaseGenerator
{
    /**
     * @var Filesystem
     */
    protected $filesystem;
    /**
     * @var Mustache_Engine
     */
    protected $mustache;
    /**
     * @var array
     */
    protected $data = [];
    /**
     * @var string
     */
    protected $templatePath;
    /**
     * @var string
     */
    protected $outputPath;
    /**
     * @param Filesystem $filesystem
     * @param Mustache_Engine $mustache
     */
    public function __construct(Filesystem $filesystem = null, Mustache_Engine $mustache = null)
    {
        $this->filesystem = $filesystem ?: new Filesystem;
        $this->mustache = $mustache ?: new Mustache_Engine;
    }

    /**
     * @param array $vars
     */
    public function setData(array $vars)
    {
        $this->data = array_merge($this->data, $vars);
    }

    /**
     * @param $packagePath
     * @throws \Illuminate\Filesystem\FileNotFoundException
     */
    public function create($packagePath)
    {
        $template = $this->filesystem->get($this->getTemplatePath());

        $output = $this->mustache->render($template, $this->data);

        $this->filesystem->put($packagePath . '/' . $this->outputPath, $output);
    }

    protected function getTemplatePath()
    {
        return realpath(__DIR__ . '/../../templates/') . '/' . $this->templatePath;
    }

    /**
     * Provides an array of directories to be made in the package directory.
     *
     * @return array
     */
    public function getDirectories()
    {
        return [];
    }
}