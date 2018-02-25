<?php

namespace FiveCardDraw\Entity\Card;

/**
 * Class Card
 * @package Entity\Card
 */
class Card implements ICard
{

    /**
     * @var string
     */
    private $suit;

    /**
     * @var string
     */
    private $rank;

    /**
     * Card constructor.
     * @param string $rank
     * @param string $suit
     */
    public function __construct(string $rank, string $suit)
    {
        $this->rank = $rank;
        $this->suit = $suit;
    }

    /**
     * @return string
     */
    public function getSuit(): string
    {
        return $this->suit;
    }

    /**
     * @return string
     */
    public function getRank(): string
    {
        return $this->rank;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return ucfirst(strtolower($this->getRank())) . ' of ' . ucfirst(strtolower($this->getSuit()));
    }
}