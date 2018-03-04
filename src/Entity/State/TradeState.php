<?php

namespace FiveCardDraw\Entity\State;


use FiveCardDraw\Entity\Game\IGame;

/**
 * Class TradeState
 * @package FiveCardDraw\Entity\State
 */
class TradeState implements IState
{
    /**
     * @var IGame
     */
    protected $game;

    /**
     * TradeState constructor.
     * @param IGame $game
     */
    public function __construct(IGame $game)
    {
        $this->game = $game;
    }


    public function play()
    {
        $this->getGame()->changeState(new DrawState($this->getGame()));
    }

    /**
     * @return IGame
     */
    public function getGame(): IGame
    {
        return $this->game;
    }
}