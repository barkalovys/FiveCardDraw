<?php

namespace FiveCardDraw\Entity\Hand;
use FiveCardDraw\Entity\Card\ICard;

/**
 * Class Flush
 * @package FiveCardDraw\Entity\Hand
 */
class Flush implements IHand
{

    /**
     * @var ICard
     */
    private $highcard;

    /**
     * @var string
     */
    private $suit;

    /**
     * Flush constructor.
     * @param ICard $highcard
     * @param string $suite
     */
    public function __construct(ICard $highcard, string $suit)
    {
        $this->highcard = $highcard;
        $this->suit = $suit;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return IHand::HAND_FLUSH;
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
        return "Flush: all {$this->suit} with {$this->highcard->getRank()} highcard";
    }

    /**
     * @return ICard
     */
    public function getHighcard(): ICard
    {
        return $this->highcard;
    }
}