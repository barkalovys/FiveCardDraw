<?php

namespace FiveCardDraw\Entity\State;


use FiveCardDraw\Entity\Game\IGame;
use FiveCardDraw\Entity\Player\IPlayer;
use FiveCardDraw\Entity\Player\IPlayerList;
use FiveCardDraw\Service\HandAnalyser\HandAnalyserService;

class PostDrawState implements IState
{
    /**
     * @var IGame
     */
    protected $game;

    public function __construct(IGame $game)
    {
        $this->game = $game;
    }

    public function play()
    {
        /** @var IPlayerList $playerList */
        $playerList = $this->getGame()->getPlayerList();
        $service = new HandAnalyserService();
        /** @var IPlayer $player */
        foreach ($playerList->getPlayers() as $player) {
            $bet = $player->getMoney() > 15 ? rand(1, $player->getMoney()) : $player->getMoney();
            $player->bet($bet);
            $this->getGame()->incPot($bet);
            $player->setHand(
                $service->getHand(
                    $player->getCards()
                )
            );
            if (!$player->getMoney()) {
                $playerList->detach($player);
            }
            if (count($playerList->getPlayers()) <= 1) {
                $this->getGame()->setWinner($player);
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