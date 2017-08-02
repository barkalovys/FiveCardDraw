<?php

namespace Entity\State;


use Entity\Game\IGame;
use Entity\Player\IPlayer;

/**
 * Class PreDrawState
 * @package Entity\State
 */
class PreDrawState implements IState
{
    /** @var  IGame */
    protected $game;

    /**
     * @param IGame $game
     */
    public function __construct(IGame $game)
    {
        $this->game = $game;
    }

    public function play()
    {
        for ($i = 0; $i < 5; ++$i) {
            /** @var IPlayer $player */
            foreach ($this->getGame()->getPlayers() as $player) {
                $player->getHand()->attach($this->getGame()->getDeck()->draw());
            }
        }
        $this->getGame()->changeState(new TradeState($this->getGame()));
        var_dump(count($this->getGame()->getDeck()));
    }

    /**
     * @return IGame
     */
    public function getGame(): IGame
    {
        return $this->game;
    }
}