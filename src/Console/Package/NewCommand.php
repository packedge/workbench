<?php namespace Packedge\Workbench\Console\Package;

use Packedge\Workbench\Console\BaseCommand;
use Packedge\Workbench\Generators\ComposerGenerator;
use Packedge\Workbench\Generators\LicenceGenerator;
use Packedge\Workbench\Generators\PackageGenerator;
use Packedge\Workbench\Generators\ReadmeGenerator;
use Packedge\Workbench\Package;
use Packedge\Workbench\Parsers\PackageParser;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\ChoiceQuestion;

class NewCommand extends BaseCommand
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
     * @var string
     */
    protected $packageDescription;
    protected $packageName;
    protected $licenceName;
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
        $this->packageName = $this->askForArgument('package', 'What is your package name?');
        $this->packageDescription = $this->askForArgument('description', 'What is your package description?');
        $this->licenceName = $this->chooseAnOption('Choose a licence', LicenceGenerator::showList());

//        $helper = $this->getHelper('question');
//        $q = new ChoiceQuestion('choose a licence', [
//            'a', 'b', 'c'
//        ]);
//
//        $color = $helper->ask($this->input, $this->output, $q);
//        $this->output->writeln('You have just selected: ' . $color);
//
//        die();

        $this->package->setPackageName($this->packageName);
        $this->parser = new PackageParser($this->packageName);
        $generator = new PackageGenerator();

        // Composer
        $composer = $this->prepareComposer();
        $generator->addGenerator($composer);

        // Licence
        $licence = $this->prepareLicence();
        $generator->addGenerator($licence);

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
            array('package', InputArgument::OPTIONAL, 'The name of the package to create (e.g. vendor/package-name).'),
            array('description', InputArgument::OPTIONAL, 'The description of the package.'),
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
            'description' => $this->packageDescription,
            'psr4' => $this->parser->toPsr4(), // allow overriding this.
            'author' => $this->option('name'), // this will be a default setting and overridden by this flag.
            'email' => $this->option('email'), // this will be a default setting and overridden by this flag.
            'licence' => $this->licenceName
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
            'description' => $this->packageDescription,
            'package' => $this->parser->toPackageName(),
            'licence' => LicenceGenerator::getLicenceName($this->licenceName)
        ]);
        return $readme;
    }

    /**
     * @return LicenceGenerator
     */
    protected function prepareLicence()
    {
        $licence = new LicenceGenerator;
        $licence->setType($this->licenceName);
        $licence->setData([
            'name' => $this->option('name'), // this will be a default setting and overridden by this flag.
            'year' => date('Y'),
        ]);
        return $licence;
    }
}
