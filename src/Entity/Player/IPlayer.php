<?php

namespace FiveCardDraw\Entity\Player;

use FiveCardDraw\Entity\Card\ICard;
use FiveCardDraw\Entity\Hand\IHand;
use FiveCardDraw\Event\Manager\EventManager;
use FiveCardDraw\Event\Manager\IEventManager;

/**
 * Interface IPlayer
 * @package FiveCardDraw\Entity\Player
 */
interface IPlayer
{

    const TRADE_STATUS_INITIAL = 0;

    const TRADE_STATUS_BETTING = 1;

    const TRADE_STATUS_RAISING = 2;

    const TRADE_STATUS_FOLD = 3;

    const TRADE_STATUS_WAITING = 4;

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getName(): string ;

    /**
     * @return float
     */
    public function getMoney(): float;

    /**
     * @param float $amount
     * @return IPlayer
     */
    public function incMoney(float $amount): IPlayer;

    /**
     * @param float $amount
     * @return mixed
     */
    public function bet(float $amount);

    /**
     * @return float
     */
    public function getCurrentBet(): float;

    /**
     * @return IHand
     */
    public function getHand(): IHand;

    /**
     * @param IHand $hand
     * @return IPlayer
     */
    public function setHand(IHand $hand): IPlayer;

    /**
     * @return array
     */
    public function getCards(): array;

    /**
     * @param ICard $card
     * @return IPlayer
     */
    public function addCard(ICard $card): IPlayer;

    /**
     * @return int
     */
    public function getTradeStatus(): int;

    /**
     * @param int $status
     * @return IPlayer
     */
    public function setTradeStatus(int $status): IPlayer;

    /**
     * @return int
     */
    public function getPosition(): int;

    /**
     * @param int $position
     * @return IPlayer
     */
    public function setPosition(int $position): IPlayer;

    /**
     * @return IEventManager
     */
    public function getEventManager(): IEventManager;

    /**
     * @param IEventManager $eventManager
     * @return IPlayer
     */
    public function setEventManager(IEventManager $eventManager): IPlayer;
}