<?php


namespace FiveCardDraw\Event\Listener;

use FiveCardDraw\Event\Event;
use FiveCardDraw\Event\PlayerEvent;

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