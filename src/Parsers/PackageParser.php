<?php namespace Packedge\Workbench\Parsers;

class PackageParser implements ParserInterface
{
    protected $packageName;

    public function __construct($packageName = null)
    {
        if($packageName)
        {
            $this->setPackageName($packageName);
        }
    }

    public function parse($packageName)
    {
        $parser = new static;
        $parser->setPackageName($packageName);
        return $parser;
    }

    public function toDirectoryName()
    {
        return str_replace('/', '-', $this->packageName);
    }

    public function toPsr4()
    {
        return str_replace(' ', '\\\\', ucwords(str_replace('/', ' ', $this->packageName)));
    }

    public function toPackageName()
    {
        return $this->packageName;
    }
    /**
     * @param mixed $packageName
     */
    public function setPackageName($packageName)
    {
        $this->packageName = trim(strtolower($packageName));
    }
}
