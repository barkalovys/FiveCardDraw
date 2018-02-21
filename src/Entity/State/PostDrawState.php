<?php

namespace Entity\State;


use Entity\Game\IGame;
use Entity\Player\IPlayer;

class PostDrawState implements IState
{
    /** @var  IGame */
    protected $game;

    public function __construct(IGame $game)
    {
        $this->game = $game;
    }

    public function play()
    {
        $players = $this->getGame()->getPlayers();
        $players->rewind();
        while ($players->valid()) {
            /** @var IPlayer $player */
            $player = $players->current();
            $players->next();
            $bet = $player->getMoney() > 15 ? rand(1, $player->getMoney()) : $player->getMoney();
            $player->bet($bet);
            $this->getGame()->pot += $bet;
            if (!$player->getMoney()) {
                $players->detach($player);
            }
            if (count($players) <= 1) {
                $this->getGame()->setWinner($players->current());
                break;
            }
        }
    }

    /**
     * @return IGame
     */
    public function getGame(): IGame
    {
        return $this->game;
    }
}