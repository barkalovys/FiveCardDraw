<?php

namespace Entity\Card;

use Entity\Rank\IRank;
use Entity\Suit\ISuit;

/**
 * Class Card
 * @package Entity\Card
 */
class Card implements ICard
{

    /**
     * @var ISuit
     */
    private $suit;

    /**
     * @var IRank
     */
    private $rank;

    /**
     * Card constructor.
     * @param IRank $rank
     * @param ISuit $suit
     */
    public function __construct(IRank $rank, ISuit $suit)
    {
        $this->rank = $rank;
        $this->suit = $suit;
    }

    /**
     * @return ISuit
     */
    public function getSuit(): ISuit
    {
        return $this->suit;
    }

    /**
     * @return IRank
     */
    public function getRank(): IRank
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