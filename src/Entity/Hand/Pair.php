<?php

namespace FiveCardDraw\Entity\Hand;

use FiveCardDraw\Entity\Card\ICard;

/**
 * Class Pair
 * @package FiveCardDraw\Entity\Hand
 */
class Pair implements IHand
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
     * Pair constructor.
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
        return IHand::HAND_ONE_PAIR;
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
        return "Pair of {$this->rank} with {$this->kicker->getRank()} kicker";
    }
}