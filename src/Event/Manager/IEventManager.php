<?php

namespace FiveCardDraw\Event\Manager;
use FiveCardDraw\Event\IEvent;
use FiveCardDraw\Event\Listener\IEventListener;


/**
 * Interface IEventManager
 * @package Event\Manager
 */
interface IEventManager
{
    /**
     * @return void
     */
    public function notify(string $eventName, IEvent $event);

    /**
     * @param IEventListener $listener
     */
    public function registerListener(IEventListener $listener);

    /**
     * @param IEventListener $listener
     */
    public function detachListener(IEventListener $listener);
}