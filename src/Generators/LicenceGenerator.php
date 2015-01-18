<?php namespace Packedge\Workbench\Generators;

use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;

class LicenceGenerator extends BaseGenerator implements GeneratorInterface
{
    /*
     * Composer Ids
     * https://github.com/composer/composer/blob/master/res/spdx-identifier.json
     */


    /**
     * @var array
     */
    protected static $licences = [
        'MIT' => [ 'file' => 'MIT.txt',  'human' => 'MIT'],
        'Apache-2.0' => [ 'file' => 'Apache-2-0.txt', 'human' => 'Apache 2.0'],
        'GPL-3' => [ 'file' => 'GPL-3.txt', 'human' => 'GNU GPL v3.0'],
    ];


    /**
     * @var string
     */
    protected $type = 'MIT';

    public function __construct(Filesystem $filesystem = null, Mustache_Engine $mustache = null)
    {
        parent::__construct($filesystem, $mustache);
        $this->outputPath = 'LICENSE';
    }

    public static function showList()
    {
        $data = array_map(function($item){
            return $item['human'];
        }, static::$licences);

        return array_flip($data);
    }

    public static function getLicenceName($key)
    {
        if(!array_key_exists($key, static::$licences)) throw new \InvalidArgumentException("Licence $key not found.");
        return static::$licences[$key]['human'];
    }

    public function setType($name)
    {
        if(!array_key_exists($name, static::$licences)) throw new \InvalidArgumentException("Licence $name not found.");
        $this->type = $name;
    }

    public function create($packagePath)
    {
        $this->templatePath = 'licences/' . static::$licences[$this->type]['file'];
        parent::create($packagePath);
    }
} 