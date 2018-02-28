<?php

namespace FiveCardDraw\Entity\Hand;


/**
 * Class RoyalFlush
 * @package FiveCardDraw\Entity\Hand
 */
class RoyalFlush implements IHand
{

    /**
     * @var string
     */
    protected $suit;


    /**
     * RoyalFlush constructor.
     * @param string $suit
     */
    public function __construct(string $suit)
    {
        $this->suit = $suit;
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