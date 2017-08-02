<?php


namespace Event\Listener;

use Event\Event;
use Event\PlayerEvent;

class PlayerEventListener implements IEventListener
{
    /**
     * @param PlayerEvent $event
     */
    public function handle(Event $event)
    {
        return 123;
    }

}