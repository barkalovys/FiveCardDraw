<?php

namespace FiveCardDraw\Entity\State;

use FiveCardDraw\Entity\Game\IGame;
use FiveCardDraw\Entity\Player\IPlayer;
use FiveCardDraw\Entity\Player\IPlayerList;
use FiveCardDraw\Event\PlayerWinRoundEvent;
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
            if ($player->isFolded()) {
                continue;
            }
            $player->setHand(
                $service->getHand(
                    $player->getCards()
                )
            );
        }
        //TODO: implement multiple winners case
        $winner = $service->getPlayersWithStrongestHand($playerList);
        $this->getGame()->getEventManager()->notify('playerWinRound', new PlayerWinRoundEvent($winner));
        if (count($playerList->getPlayers()) <= 1) {
            $this->getGame()->setWinner($winner);
            return;
        }
        $this->getGame()->changeState(new PreDrawState($this->getGame()));
    }

    /**
     * @return IGame
     */
    public function getGame(): IGame
    {
        return $this->game;
    }
}