<?php namespace Packedge\Workbench\Foundation;

class EventManager
{
    protected $events = [];

    public function listen($name, $className)
    {
        if(!is_string($className)) throw new InvalidArgumentException;
        $this->events[$name][] = new $className($this);
    }

    public function fire($name, $data)
    {
        foreach($this->events[$name] as $event => $object)
        {
            $object->{'handle'}($data);
        }
    }
}