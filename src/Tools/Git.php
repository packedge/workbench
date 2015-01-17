<?php namespace Packedge\Workbench\Tools;

use Symfony\Component\Process\ExecutableFinder;

class Git
{
    /**
     * @var string
     */
    protected $repositoryPath;
    /**
     * @var ExecutableFinder
     */
    private $executableFinder;

    /**
     * @param string $repositoryPath
     * @param ExecutableFinder $executableFinder
     */
    public function __construct($repositoryPath, ExecutableFinder $executableFinder)
    {
        $this->repositoryPath = realpath($repositoryPath);
        $this->executableFinder = $executableFinder ?: new ExecutableFinder;
    }

    public function hasGit()
    {
        $result = $this->executableFinder->find('git');
        var_dump($result);
    }

    public function init()
    {
        $this->execute('git init');
    }

    public function add(array $files)
    {
        // TODO: logic
    }

    public function addAll()
    {
        // TODO: logic
    }

    public function commit($message)
    {
        // TODO: logic
    }

    public function setRemote($url)
    {
        // TODO: logic
    }

    public function push()
    {
        // TODO: logic
    }

    /**
     * @param  string  $command
     * @throws RuntimeException
     */
    protected function execute($command)
    {
        $cwd = getcwd();
        chdir($this->repositoryPath);
        exec($command, $output, $returnValue);
        chdir($cwd);
        if ($returnValue !== 0) {
            throw new RuntimeException($output);
        }
        return $output;
    }
} 