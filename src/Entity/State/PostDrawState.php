<?php

namespace FiveCardDraw\Entity\State;


use FiveCardDraw\Entity\Game\IGame;
use FiveCardDraw\Entity\Player\IPlayer;
use FiveCardDraw\Entity\Player\IPlayerList;
use FiveCardDraw\Event\PlayerEvent;
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
        }
        
        //TODO: implement multiple winners case
        $winner = $service->getPlayersWithStrongestHand($playerList);
        //TODO: hide all money logic inside listeners
        $winner->incMoney($this->getGame()->getPot());
        $this->getGame()->getEventManager()->notify('playerWinPot', new PlayerEvent($winner));
        if (count($playerList->getPlayers()) <= 1) {
            $this->getGame()->setWinner($player);
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