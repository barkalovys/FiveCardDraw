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
use FiveCardDraw\Event\PlayerEvent;
use FiveCardDraw\Service\Deck\IDeckBuilder;

/**
 * Class FiveCardDraw
 * @package Entity\Game\FiveCardDraw
 */
class FiveCardDraw implements IGame, IEventListener
{

    const MAX_CARDS_IN_HAND = 5;

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
     * FiveCardDraw constructor.
     * @param IDeck $deck
     * @param IPlayerList $playerList
     */
    public function __construct(IDeck $deck, IPlayerList $playerList)
    {
        $this->state = new PreDrawState($this);
        $this->deck = $deck;
        $this->playerList = $playerList;
        $this->eventManager = new EventManager();
        $this->initEventManager();
    }


    public function play()
    {
        while (!$this->winner) {
            $this->state->play();
        }
        $handString = '';
        foreach ($this->winner->getCards() as $card) {
            $handString .= $card . ', ';
        }
        echo "Player {$this->getWinner()} wins {$this->getPot()}$ with hand {$this->getWinner()->getHand()}!" . PHP_EOL;
        echo "($handString)" . PHP_EOL;
    }

    protected function initEventManager()
    {
        /** @var EventManager $eventManager */
        $eventManager = $this->eventManager;
        $eventManager->registerListener($this);
        /** @var IPlayer $player */
        foreach ($this->playerList->getPlayers() as $player) {
            $player->setEventManager($eventManager);
            $eventManager->registerListener($player);
        }
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
     * @return int
     */
    public function getPot(): int
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
    }

    /**
     * @return int
     */
    public function getSmallBlindBet(): int
    {
        return $this->smallBlindBet;
    }

    public function onPlayerBet(PlayerEvent $event)
    {
        $this->incPot($event->getPlayer()->getCurrentBet());
    }

    public function onPlayerWinPot()
    {
        $this->pot = 0.0;
    }
}