<?php

namespace FiveCardDraw\Entity\State;


use FiveCardDraw\Entity\Game\IGame;
use FiveCardDraw\Entity\Player\IPlayer;
use FiveCardDraw\Event\Listener\IEventListener;
use FiveCardDraw\Event\PlayerBetEvent;

/**
 * Class TradeState
 * @package FiveCardDraw\Entity\State
 */
class TradeState implements IState, IEventListener
{
    /**
     * @var IGame
     */
    protected $game;

    /**
     * @var bool
     */
    private $stakesAdjusted = false;

    /**
     * @var float
     */
    private $maxStake = 0.0;

    /**
     * TradeState constructor.
     * @param IGame $game
     */
    public function __construct(IGame $game)
    {
        $this->game = $game;
        $this->game->getEventManager()->registerListener($this);
    }

    /**
     * Trade state lasts until stakes are equalized, e.g. $stakesAdjusted === true
     */
    public function play()
    {
        $game = $this->getGame();
        $playersList = $game->getPlayerList();
        $firstRound = true;
        $playersList->getByPosition(0)->bet($game->getSmallBlindBet());
        $playersList->getByPosition(1)->bet(2 * $game->getSmallBlindBet());
        do {
            /** @var IPlayer $player */
            foreach ($playersList->getPlayers() as $player) {
                //skip blinds on the first round
                if ($firstRound && ($player->getPosition() === 0 || $player->getPosition() === 1)) {
                    continue;
                }

                if (!$player->getMoney() || $player->isFolded()) {
                    continue;
                }
                $bet = $player->getUserInput()->inputBet($player, $this);
                $player->bet($bet);
            }
            $firstRound = false;
        } while(!$this->stakesAdjusted);
        $this->getGame()->changeState(new DrawState($this->getGame()));
        $this->getGame()->getEventManager()->detachListener($this);
    }

    /**
     * Determine current max stake and check if stakes are equalized
     * @param PlayerBetEvent $event
     */
    public function onPlayerBet(PlayerBetEvent $event)
    {
        $this->maxStake = $event->getBet() > $this->maxStake ? $event->getBet() : $this->maxStake;
        $this->stakesAdjusted = true;
        /** @var IPlayer $player */
        foreach ($this->getGame()->getPlayerList()->getPlayers() as $player) {
            if (!$player->isFolded() && $player->getMoney() && $player->getCurrentBet() < $this->maxStake) {
                $this->stakesAdjusted = false;
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

    /**
     * @return float
     */
    public function getMaxStake(): float
    {
        return $this->maxStake;
    }

}