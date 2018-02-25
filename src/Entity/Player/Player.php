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
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
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
     * @param int $money
     */
    public function __construct(string $name, int $money)
    {
        $this->name = $name;
        $this->money = $money;
        $this->cards = [];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMoney(): int
    {
        return $this->money;
    }

    /**
     * @param int $money
     * @throws \Exception
     */
    public function bet(int $money)
    {
        if ($money < 0) {
            throw new \Exception('Invalid bet');
        }

        if ($money > $this->getMoney()) {
            throw new \Exception('Not enough money to bet ' . $money);
        }

        $this->money -= $money;
    }

    public function getHand():IHand
    {
        return $this->hand;
    }

    public function setHand(IHand $hand):IPlayer
    {
        $this->hand = $hand;
        return $this;
    }

    public function getCards():array
    {
        return $this->cards;
    }

    public function drawCard(ICard $card):IPlayer
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

}