<?php

namespace Entity\Game\FiveCardDraw;

use Entity\Deck\IDeck;
use Entity\Game\IGame;
use Entity\Player\IPlayer;
use Entity\Player\IPlayerList;
use Entity\State\IState;
use Entity\State\PreDrawState;
use Service\Deck\IDeckBuilder;

/**
 * Class FiveCardDraw
 * @package Entity\Game\FiveCardDraw
 */
class FiveCardDraw implements IGame
{
    /**
     *
     */
    const MAX_CARDS_IN_HAND = 5;

    /**
     * @var \Entity\Deck\IDeck
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
     * @param IDeckBuilder $builder
     * @param IPlayerList $playerList
     */
    public function __construct(IDeckBuilder $builder, IPlayerList $playerList)
    {
        $state = new PreDrawState($this);
        $this->state = $state;
        $this->deck = $builder->build();
        $this->players = $playerList;
    }


    public function play()
    {
        while (!$this->winner) {
            $this->state->play();
        }
        $handString = '';
        foreach ($this->winner->getHand() as $card) {
            $handString .= $card . ', ';
        }
        echo "Player {$this->winner} wins {$this->pot}$ with hand {$handString}!" . PHP_EOL;
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