<?php

namespace FiveCardDraw\Event\Manager;


/**
 * Interface IEventManger
 * @package Event\Manager
 */
interface IEventManger
{
    /**
     * @return void
     */
    public function notify();
}