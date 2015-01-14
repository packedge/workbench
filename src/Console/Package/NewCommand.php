<?php namespace Packedge\Workbench\Console\Package;

use Illuminate\Console\Command;
use Packedge\Workbench\Generators\ComposerGenerator;
use Packedge\Workbench\Generators\PackageGenerator;
use Packedge\Workbench\Generators\ReadmeGenerator;
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
     * @var Parser
     */
    protected $parser;
    /**
     * @var Package
     */
    private $package;

    public function __construct(Package $package)
    {
        parent::__construct();
        $this->package = $package;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->package->setPackageName($this->argument('package'));
        $this->parser = new PackageParser($this->argument('package'));
        $generator = new PackageGenerator();

        // Composer
        $composer = $this->prepareComposer();
        $generator->addGenerator($composer);

        // Readme
        $readme = $this->prepareReadme();
        $generator->addGenerator($readme);

        // Create the Package
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
            array('name', null, InputOption::VALUE_REQUIRED, 'The package creators name.', null),
            array('email', null, InputOption::VALUE_REQUIRED, 'The package creators email.', null),
//            array('force', null, InputOption::VALUE_NONE, 'Force the operation to run when the file already exists.'),
        );
    }

    /**
     * @return ComposerGenerator
     */
    protected function prepareComposer()
    {
        $composer = new ComposerGenerator;
        $composer->setData([
            'name' => $this->parser->toPackageName(),
            'description' => trim($this->argument('description')),
            'psr4' => $this->parser->toPsr4(), // allow overriding this.
            'author' => $this->option('name'), // this will be a default setting and overridden by this flag.
            'email' => $this->option('email'), // this will be a default setting and overridden by this flag.
        ]);
        return $composer;
    }

    /**
     * @return ReadmeGenerator
     */
    protected function prepareReadme()
    {
        $readme = new ReadmeGenerator;
        $readme->setData([
            'name' => $this->parser->toHuman(),
            'description' => trim($this->argument('description')),
            'package' => $this->parser->toPackageName()
        ]);
        return $readme;
    }
}
