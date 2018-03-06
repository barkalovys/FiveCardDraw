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
     * Give cards to each player and post blinds
     */
    public function play()
    {
        $game = $this->getGame();
        $playerList = $game->getPlayerList();
        for ($i = 0; $i < 5; ++$i) {
            /** @var IPlayer $player */
            foreach ($playerList->getPlayers() as $player) {
                $player->addCard($game->getDeck()->draw());
            }
        }
        $playerList->getByPosition(0)->bet($game->getSmallBlindBet());
        $playerList->getByPosition(1)->bet(2 * $game->getSmallBlindBet());
        $game->changeState(new TradeState($game));
    }

    /**
     * @return IGame
     */
    public function getGame(): IGame
    {
        return $this->game;
    }
}