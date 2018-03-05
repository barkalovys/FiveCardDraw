<?php

namespace FiveCardDraw\Event\Listener;


use FiveCardDraw\Event\Event;

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