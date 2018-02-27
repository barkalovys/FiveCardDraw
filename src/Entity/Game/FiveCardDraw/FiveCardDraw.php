<?php

namespace FiveCardDraw\Entity\Game\FiveCardDraw;

use FiveCardDraw\Entity\Deck\IDeck;
use FiveCardDraw\Entity\Game\IGame;
use FiveCardDraw\Entity\Player\IPlayer;
use FiveCardDraw\Entity\Player\IPlayerList;
use FiveCardDraw\Entity\State\IState;
use FiveCardDraw\Entity\State\PreDrawState;
use FiveCardDraw\Service\Deck\IDeckBuilder;

/**
 * Class FiveCardDraw
 * @package Entity\Game\FiveCardDraw
 */
class FiveCardDraw implements IGame
{

    const MAX_CARDS_IN_HAND = 5;

    /**
     * @var IDeck
     */
    public $deck;

    /**
     * @var IPlayerList
     */
    protected $players;

    /**
     * @var int
     */
    public $pot = 0;

    /** @var  IState */
    protected $state;

    /**
     * @var IPlayer
     */
    protected $winner;

    /**
     * FiveCardDraw constructor.
     * @param IDeck $deck
     * @param IPlayerList $playerList
     */
    public function __construct(IDeck $deck, IPlayerList $playerList)
    {
        $state = new PreDrawState($this);
        $this->state = $state;
        $this->deck = $deck;
        $this->players = $playerList;
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
        echo "Player {$this->winner} wins {$this->pot}$ with hand {$this->winner->getHand()}!" . PHP_EOL;
        echo "($handString)" . PHP_EOL;
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
    public function getPlayers(): IPlayerList
    {
        return $this->players;
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


}