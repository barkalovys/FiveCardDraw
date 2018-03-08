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
        $game = $this->getGame();
        $playerList = $game->getPlayerList();
        /** @var IPlayer $player */
        array_map(function($player){
            $player->removeCards();
        }, $playerList->getPlayers());
        $this->getGame()->setDeck((new \FiveCardDraw\Service\Deck\StandardDeckBuilder())->build());
        for ($i = 0; $i < 5; ++$i) {
            /** @var IPlayer $player */
            foreach ($playerList->getPlayers() as $player) {
                $player->addCard($game->getDeck()->draw());
            }
        }
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