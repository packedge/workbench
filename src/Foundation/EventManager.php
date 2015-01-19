<?php namespace Packedge\Workbench\Foundation;

class EventManager
{
    protected $events = [];

    public function listen($name, $obj)
    {
        if(!is_object($obj)) throw new InvalidArgumentException;
        $this->events[$name][] = $obj;
    }

    public function fire($name, $data)
    {
        foreach($this->events[$name] as $event => $object)
        {
            $object->{'handle'}($data);
        }
    }
}