<?php namespace Packedge\Workbench\Foundation;

abstract class EventListener
{
    /**
     * @var EventManager
     */
    protected $manager;

    public function __construct(EventManager $manager)
    {
        $this->manager = $manager;
    }
} 