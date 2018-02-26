<?php

namespace FiveCardDraw\Entity\Hand;

use FiveCardDraw\Entity\Card\ICard;

/**
 * Class StraightFlush
 * @package FiveCardDraw\Entity\Hand
 */
class StraightFlush implements IHand
{

    /**
     * @var string
     */
    protected $suit;

    /**
     * @var string
     */
    private $firstCardRank;

    /**
     * @var string
     */
    private $lastCardRank;

    /**
     * StraightFlush constructor.
     * @param string $suit
     * @param string $firstCardRank
     * @param string $lastCardRank
     */
    public function __construct(string $suit, string $firstCardRank, string $lastCardRank)
    {
        $this->suit = $suit;
        $this->firstCardRank = $firstCardRank;
        $this->lastCardRank = $lastCardRank;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return IHand::HAND_STRAIGHT_FLUSH;
    }

    /**
     * @return int
     */
    public function getName():int
    {
        // TODO: Implement getName() method.
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Straight flush: from {$this->firstCardRank} to {$this->lastCardRank} all {$this->suit}";
    }
}