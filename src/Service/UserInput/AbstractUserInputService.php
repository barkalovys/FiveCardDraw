<?php

namespace FiveCardDraw\Service\UserInput;

use FiveCardDraw\Entity\Player\IPlayer;
use FiveCardDraw\Entity\State\TradeState;

abstract class AbstractUserInputService
{

    /**
     * @var AbstractUserInputService
     */
    protected static $instance;

    protected function __construct(){}

    /**
     * @return AbstractUserInputService
     */
    public static function getInstance(): AbstractUserInputService
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    abstract public function inputBet(IPlayer $player, TradeState $state);
}