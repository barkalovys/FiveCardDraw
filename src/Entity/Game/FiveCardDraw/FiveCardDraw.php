<?php

namespace FiveCardDraw\Entity\Game\FiveCardDraw;

use FiveCardDraw\Entity\Deck\IDeck;
use FiveCardDraw\Entity\Game\IGame;
use FiveCardDraw\Entity\Player\IPlayer;
use FiveCardDraw\Entity\Player\IPlayerList;
use FiveCardDraw\Entity\State\IState;
use FiveCardDraw\Entity\State\PreDrawState;
use FiveCardDraw\Event\Listener\IEventListener;
use FiveCardDraw\Event\Manager\EventManager;
use FiveCardDraw\Event\Manager\IEventManager;
use FiveCardDraw\Event\PlayerBetEvent;
use FiveCardDraw\Event\PlayerWinGameEvent;
use FiveCardDraw\Event\PlayerWinRoundEvent;
use FiveCardDraw\Service\Deck\IDeckBuilder;
use FiveCardDraw\Service\Logger\GameLogger;
use FiveCardDraw\Service\Logger\ILogger;

/**
 * Class FiveCardDraw
 * @package Entity\Game\FiveCardDraw
 */
class FiveCardDraw implements IGame, IEventListener
{

    const MAX_CARDS_IN_HAND = 5;

    const MAX_PLAYERS = 10;

    /**
     * @var IDeck
     */
    public $deck;

    /**
     * @var IPlayerList
     */
    protected $playerList;

    /**
     * @var float
     */
    protected $pot = 0.0;

    /**
     * @var int
     */
    protected $smallBlindBet = 5;

    /**
     * @var IState
     */
    protected $state;

    /**
     * @var IPlayer
     */
    protected $winner;

    /**
     * @var IEventManager
     */
    protected $eventManager;

    /**
     * @var ILogger
     */
    protected $logger;

    /**
     * FiveCardDraw constructor.
     * @param IDeck $deck
     * @param IPlayerList $playerList
     */
    public function __construct(IDeck $deck, IPlayerList $playerList)
    {
        if (count($playerList->getPlayers()) > self::MAX_PLAYERS) {
            throw new \InvalidArgumentException('Maximum ' . self::MAX_PLAYERS . ' players limit exceeded');
        }
        $this->state = new PreDrawState($this);
        $this->deck = $deck;
        $this->playerList = $playerList;
        $this->eventManager = new EventManager();
        $this->logger = new GameLogger();
        $this->initEventManager();
    }


    public function play()
    {
        while (!$this->winner) {
            $this->state->play();
        }
    }

    protected function initEventManager()
    {
        $eventManager = $this->getEventManager();
        $eventManager->registerListener($this);
        $eventManager->registerListener($this->logger);
        /** @var IPlayer $player */
        foreach ($this->playerList->getPlayers() as $player) {
            $player->setEventManager($eventManager);
            $eventManager->registerListener($player);
        }
        $eventManager->registerListener($this->playerList);
    }

    /**
     * @param IState $state
     */
    public function changeState(IState $state)
    {
        $this->state = $state;
    }

    /**
     * @return IPlayerList
     */
    public function getPlayerList(): IPlayerList
    {
        return $this->playerList;
    }

    /**
     * @return IDeck
     */
    public function getDeck(): IDeck
    {
        return $this->deck;
    }

    /**
     * @param IDeck $deck
     * @return $this
     */
    public function setDeck(IDeck $deck): IGame
    {
        $this->deck = $deck;
        return $this;
    }

    /**
     * @return float
     */
    public function getPot(): float
    {
        return $this->pot;
    }

    /**
     * @param float $amount
     * @return IGame
     */
    public function incPot(float $amount): IGame
    {
        $this->pot += $amount;
        return $this;
    }

    /**
     * @param float $amount
     * @return IGame
     */
    public function decPot(float $amount): IGame
    {
        $this->pot = ($this->pot > $amount) ? $this->pot - $amount : 0;
        return $this;
    }

    /**
     * @return IState
     */
    public function getState(): IState
    {
        return $this->state;
    }

    /**
     * @return IPlayer
     */
    public function getWinner(): IPlayer
    {
        return $this->winner;
    }

    /**
     * @param IPlayer $winner
     */
    public function setWinner(IPlayer $winner)
    {
        $this->winner = $winner;
        $this->getEventManager()->notify('playerWinGame', new PlayerWinGameEvent($winner));
    }

    /**
     * @return int
     */
    public function getSmallBlindBet(): int
    {
        return $this->smallBlindBet;
    }

    /**
     * @param PlayerBetEvent $event
     */
    public function onPlayerBet(PlayerBetEvent $event)
    {
        $this->incPot($event->getBet());
    }


    /**
     * @param PlayerWinRoundEvent $event
     */
    public function onPlayerWinRound(PlayerWinRoundEvent $event)
    {
        $winnerBet = $event->getPlayer()->getCurrentBet();
        $winMoney = $winnerBet;
        /** @var IPLayer $player */
        foreach($this->getPlayerList()->getPlayers() as $player) {
            $player->setTradeStatus(IPlayer::TRADE_STATUS_WAITING);
            if ($player === $event->getPlayer()) {
                $player->clearCurrentBet();
                continue;
            }
            $playerBet = $player->getCurrentBet();
            if ($winnerBet < $playerBet) {
                $winMoney += $winnerBet;
                $player->incMoney($playerBet - $winnerBet);
            } else {
                if (!$player->getMoney()) {
                    $this->getPlayerList()->detach($player);
                }
                $winMoney += $playerBet;
            }
            $player->clearCurrentBet();
        }
        $event->getPlayer()->incMoney($winMoney);
        $this->pot = 0.0;
    }

    /**
     * @return IEventManager
     */
    public function getEventManager(): IEventManager
    {
        return $this->eventManager;
    }

    /**
     * @return ILogger
     */
    public function getLogger(): ILogger
    {
        return $this->logger;
    }

}