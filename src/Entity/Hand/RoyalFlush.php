<?php

namespace FiveCardDraw\Entity\Hand;


use FiveCardDraw\Entity\Card\ICard;

/**
 * Class RoyalFlush
 * @package FiveCardDraw\Entity\Hand
 */
class RoyalFlush extends StraightFlush implements IHand
{
    /**
     * RoyalFlush constructor.
     * @param string $suit
     */
    public function __construct(string $suit)
    {
        parent::__construct($suit, ICard::RANK_ACE, ICard::RANK_TEN);
    }


    /**
     * @return int
     */
    public function getStrength(): int
    {
        return IHand::HAND_ROYAL_FLUSH;
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
        return "Royal flush! All cards {$this->suit}.";
    }
}