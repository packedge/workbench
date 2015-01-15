<?php namespace Packedge\Workbench\Tools;

class Git
{
    /**
     * @var string
     */
    protected $repositoryPath;

    /**
     * @param string $repositoryPath
     */
    public function __construct($repositoryPath)
    {
        $this->repositoryPath = realpath($repositoryPath);
    }

    public function hasGit()
    {
        // TODO: logic
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