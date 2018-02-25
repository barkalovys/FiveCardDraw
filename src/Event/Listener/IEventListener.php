<?php

namespace FiveCardDraw\Event\Listener;


use Event\Event;

/**
 * Interface IEventListener
 * @package Event\Listener
 */
interface IEventListener
{
    /**
     * @param Event $event
     */
    public function handle(Event $event);
}