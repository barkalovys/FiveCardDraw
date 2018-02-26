<?php

namespace FiveCardDraw\Entity\Hand;

/**
 * Class FullHouse
 * @package FiveCardDraw\Entity\Hand
 */
class FullHouse implements IHand
{

    /**
     * @var string
     */
    private $threeCardsRank;

    /**
     * @var string
     */
    private $pairRank;

    /**
     * FullHouse constructor.
     * @param string $threeCardsRank
     * @param string $pairRank
     */
    public function __construct(string $threeCardsRank, string $pairRank)
    {
        $this->threeCardsRank = $threeCardsRank;
        $this->pairRank = $pairRank;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return IHand::HAND_FULL_HOUSE;
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
        return "Full house: {$this->threeCardsRank}s over {$this->pairRank}s";
    }
}