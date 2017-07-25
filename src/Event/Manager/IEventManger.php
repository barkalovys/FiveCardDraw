<?php

namespace Event\Manager;


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