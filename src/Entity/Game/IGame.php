<?php

namespace FiveCardDraw\Entity\Game;


use FiveCardDraw\Entity\Deck\IDeck;
use FiveCardDraw\Entity\Player\IPlayerList;
use FiveCardDraw\Entity\State\IState;
use FiveCardDraw\Event\Manager\IEventManager;

/**
 * Interface IGame
 * @package Entity\Game
 */
interface IGame
{
    /**
     * @return mixed
     */
    public function play();

    /**
     * @param IState $state
     */
    public function changeState(IState $state);

    /**
     * @return IPlayerList
     */
    public function getPlayerList(): IPlayerList;

    /**
     * @return IDeck
     */
    public function getDeck(): IDeck;

    /**
     * @param IDeck $deck
     * @return IGame
     */
    public function setDeck(IDeck $deck): IGame;

    /**
     * @return int
     */
    public function getSmallBlindBet(): int;

    /**
     * @return float
     */
    public function getPot(): float;

    /**
     * @param float $amount
     * @return IGame
     */
    public function incPot(float $amount): IGame;

    /**
     * @param float $amount
     * @return IGame
     */
    public function decPot(float $amount): IGame;

    /**
     * @return IEventManager
     */
    public function getEventManager(): IEventManager;
}