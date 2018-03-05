<?php

namespace FiveCardDraw\Event\Manager;


use FiveCardDraw\Event\IEvent;
use FiveCardDraw\Event\Listener\IEventListener;

/**
 * Class EventManager
 * @package FiveCardDraw\Event\Manager
 */
class EventManager implements IEventManager
{

    /**
     * @var \SplObjectStorage
     */
    private $listeners;


    public function __construct()
    {
        $this->listeners = new \SplObjectStorage();
    }


    /**
     * @param string $eventName
     * @param IEvent $event
     * @throws \Exception
     */
    public function notify(string $eventName, IEvent $event)
    {
        $method = 'on' . ucfirst($eventName);
        /** @var IEventListener $listener */
        foreach ($this->listeners as $listener) {
            if (!method_exists($listener, $method)) {
                throw new \Exception('Class ' . $listener::class . 'need to implement method ' . $method);
            }
            call_user_func([$listener, $method], $event);
        }
    }

    /**
     * @param IEventListener $listener
     */
    public function registerListener(IEventListener $listener)
    {
        $this->listeners->attach($listener);
    }

}