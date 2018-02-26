<?php

namespace FiveCardDraw\Entity\Hand;

/**
 * Class Straight
 * @package FiveCardDraw\Entity\Hand
 */
class Straight implements IHand
{

    /**
     * @var string
     */
    private $firstCardRank;

    /**
     * @var string
     */
    private $lastCardRank;

    /**
     * Straight constructor.
     * @param string $firstCardRank
     * @param string $lastCardRank
     */
    public function __construct(string $firstCardRank, string $lastCardRank)
    {
        $this->firstCardRank = $firstCardRank;
        $this->lastCardRank = $lastCardRank;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return IHand::HAND_STRAIGHT;
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
        return "Straight: from {$this->firstCardRank} to {$this->lastCardRank}";
    }
}