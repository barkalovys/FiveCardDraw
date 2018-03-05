<?php

namespace FiveCardDraw\Entity\Player;
use FiveCardDraw\Entity\Card\ICard;
use FiveCardDraw\Entity\Hand\IHand;


/**
 * Class Player
 * @package Entity\Player
 */
class Player implements IPlayer
{

    const PLAYER_STATUS_LIST = [
        self::TRADE_STATUS_INITIAL,
        self::TRADE_STATUS_BETTING,
        self::TRADE_STATUS_RAISING,
        self::TRADE_STATUS_FOLD,
        self::TRADE_STATUS_WAITING,
    ];

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $tradeStatus;

    /**
     * @var int
     */
    protected $position;

    /**
     * @var float
     */
    protected $currentBet;

    /**
     * @var float
     */
    protected $money;

    /**
     * @var array
     */
    public $cards;

    /**
     * @var IHand
     */
    public $hand = null;

    /**
     * Player constructor.
     * @param string $name
     * @param float $money
     * @param int $position
     */
    public function __construct(string $name, float $money, int $position)
    {
        $this->name = $name;
        $this->money = $money;
        $this->cards = [];
        $this->status = self::TRADE_STATUS_INITIAL;
        $this->position = $position;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getMoney(): float
    {
        return $this->money;
    }

    /**
     * @param float $amount
     * @throws \Exception
     */
    public function bet(float $amount)
    {
        if ($amount < 0) {
            throw new \Exception('Invalid bet');
        }

        if ($amount > $this->getMoney()) {
            $amount = $this->getMoney();
        }

        $this->money -= $amount;
        $this->currentBet += $amount;
    }

    /**
     * @return float
     */
    public function getCurrentBet(): float
    {
        return $this->currentBet;
    }


    /**
     * @return IHand
     */
    public function getHand():IHand
    {
        return $this->hand;
    }

    /**
     * @param IHand $hand
     * @return IPlayer
     */
    public function setHand(IHand $hand):IPlayer
    {
        $this->hand = $hand;
        return $this;
    }

    /**
     * @return array
     */
    public function getCards():array
    {
        return $this->cards;
    }

    /**
     * @param ICard $card
     * @return IPlayer
     */
    public function addCard(ICard $card):IPlayer
    {
        $this->cards[] = $card;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getTradeStatus(): int
    {
        return $this->tradeStatus;
    }

    /**
     * @param int $status
     * @return IPlayer
     */
    public function setTradeStatus(int $status): IPlayer
    {
        if (!in_array($status, self::PLAYER_STATUS_LIST)) {
            throw new \InvalidArgumentException('Attempt to set non-existent player status ' . $status);
        }
        $this->tradeStatus = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return IPlayer
     */
    public function setPosition(int $position): IPlayer
    {
        $this->position = $position;
        return $this;
    }

}