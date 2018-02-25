<?php

namespace FiveCardDraw\Entity\State;


use FiveCardDraw\Entity\Game\IGame;
use FiveCardDraw\Entity\Player\IPlayer;

/**
 * Class PreDrawState
 * @package Entity\State
 */
class PreDrawState implements IState
{
    /**
     * @var IGame
     */
    protected $game;

    /**
     * @param IGame $game
     */
    public function __construct(IGame $game)
    {
        $this->game = $game;
    }

    /**
     * Give cards to each player
     */
    public function play()
    {
        for ($i = 0; $i < 5; ++$i) {
            /** @var IPlayer $player */
            foreach ($this->getGame()->getPlayers() as $player) {
                $player->drawCard($this->getGame()->getDeck()->draw());
            }
        }
        $this->getGame()->changeState(new TradeState($this->getGame()));
    }

    /**
     * @return IGame
     */
    public function getGame(): IGame
    {
        return $this->game;
    }
}