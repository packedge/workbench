<?php namespace Packedge\Workbench\Generators;

use Illuminate\Filesystem\Filesystem;
use Packedge\Workbench\Package;
use Packedge\Workbench\Exceptions\DirectoryExistsException;
use Packedge\Workbench\Parsers\PackageParser;

class PackageGenerator
{
    /**
     * @var string
     */
    protected $packagePath;
    /**
     * @var PackageParser
     */
    private $packageParser;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var GeneratorInterface[]
     */
    private $generators = [];

    protected $directories = [
        'src'
    ];

    public function __construct(PackageParser $packageParser = null, Filesystem $filesystem = null)
    {
        $this->packageParser = $packageParser ?: new PackageParser;
        $this->filesystem = $filesystem ?: new Filesystem;
    }

    public function create(Package $package)
    {
        $this->packagePath = getcwd() . '/' . $this->packageParser->parse($package->getPackageName())->toDirectoryName();
        if($this->filesystem->exists($this->packagePath)) throw new DirectoryExistsException($this->packagePath);

        $this->setup();
        foreach($this->generators as $generator)
        {
            $this->buildDirectories($generator->getDirectories());
            $generator->create($this->packagePath);
        }
    }

    protected function setup()
    {
        $this->buildBaseDirectories();
    }

    protected function buildBaseDirectories()
    {
        $this->filesystem->makeDirectory($this->packagePath);
        $this->buildDirectories($this->directories);
    }

    protected function buildDirectories(array $dirs)
    {
        foreach($dirs as $dir)
        {
            $this->filesystem->makeDirectory($this->packagePath . '/' . $dir);
        }
    }

    /**
     * @param GeneratorInterface $generators
     */
    public function addGenerator(GeneratorInterface $generators)
    {
        $this->generators[] = $generators;
    }

    /**
     * @return array
     */
    public function getDirectories()
    {
        return $this->directories;
    }
}
