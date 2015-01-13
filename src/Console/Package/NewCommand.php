<?php namespace Packedge\Workbench\Console\Package;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Packedge\Workbench\Generators\ComposerGenerator;
use Packedge\Workbench\Generators\PackageGenerator;
use Packedge\Workbench\Package;
use Packedge\Workbench\Parsers\PackageParser;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class NewCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'package:new';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new package';
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Package
     */
    private $package;

    public function __construct(Filesystem $filesystem, Package $package)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
        $this->package = $package;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $parser = new PackageParser($this->argument('package'));

        $this->package->setPackageName($parser->toPackageName());

        $generator = new PackageGenerator();

        $composer = new ComposerGenerator;
        $composer->setData([
            'name' => $parser->toPackageName(),
            'description' => trim($this->argument('description')),
            'psr4' => $parser->toPsr4(), // allow overriding this.
        ]);

        $generator->addGenerator($composer);
        $generator->create($this->package);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('package', InputArgument::REQUIRED, 'The name of the package to create (e.g. vendor/package-name).'),
            array('description', InputArgument::REQUIRED, 'The description of the package.'),
        );
    }
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
//            array('path', null, InputOption::VALUE_OPTIONAL, 'The path to the configuration files.', null),
//            array('force', null, InputOption::VALUE_NONE, 'Force the operation to run when the file already exists.'),
        );
    }
}
