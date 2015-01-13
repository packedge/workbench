<?php namespace Packedge\Workbench\Generators;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;

class ReadmeGenerator implements GeneratorInterface
{

    /**
     * @var string
     */
    protected $templatePath;
    /**
     * @var string
     */
    protected $outputPath;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Mustache_Engine
     */
    private $mustache;
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param Filesystem $filesystem
     * @param Mustache_Engine $mustache
     */
    public function __construct(Filesystem $filesystem = null, Mustache_Engine $mustache = null)
    {
        $this->templatePath = __DIR__ . '/../../templates/readme.txt';
        $this->outputPath = 'README.md';
        $this->filesystem = $filesystem ?: new Filesystem;
        $this->mustache = $mustache ?: new Mustache_Engine;
    }

    public function setData(array $vars)
    {
        $this->data = array_merge($this->data, $vars);
    }

    public function create($packagePath)
    {
        $template = $this->filesystem->get($this->templatePath);

        $output = $this->mustache->render($template, $this->data);

        $this->filesystem->put($packagePath . '/' . $this->outputPath, $output);
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