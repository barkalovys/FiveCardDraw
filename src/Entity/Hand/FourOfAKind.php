<?php

namespace FiveCardDraw\Entity\Hand;

use FiveCardDraw\Entity\Card\ICard;

/**
 * Class FourOfAKind
 * @package FiveCardDraw\Entity\Hand
 */
class FourOfAKind implements IHand
{
    /**
     * @var ICard
     */
    private $kicker;

    /**
     * @var string
     */
    private $rank;

    /**
     * FourOfAKind constructor.
     * @param ICard $kicker
     * @param string $rank
     */
    public function __construct(ICard $kicker, string $rank)
    {
        $this->kicker = $kicker;
        $this->rank = $rank;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return IHand::HAND_FOUR_OF_A_KIND;
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
        return "Four of a kind: {$this->rank}s with {$this->kicker->getRank()} kicker.";
    }

    /**
     * @return ICard
     */
    public function getKicker(): ICard
    {
        return $this->kicker;
    }

}