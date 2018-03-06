<?php

namespace FiveCardDraw\Service\Logger;

/**
 * Interface ILogger
 * @package FiveCardDraw\Service\Logger
 */
interface ILogger
{
    /**
     * @param string $text
     */
    public function log(string $text);
}