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
     * @var array
     */
    private $listeners = [];


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
                continue;
            }
            call_user_func([$listener, $method], $event);
        }
    }

    /**
     * @param IEventListener $listener
     */
    public function registerListener(IEventListener $listener)
    {
        $this->listeners[spl_object_hash($listener)] = $listener;
    }

    /**
     * @param IEventListener $listener
     */
    public function detachListener(IEventListener $listener)
    {
        unset($this->listeners[spl_object_hash($listener)]);
    }

}