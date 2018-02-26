<?php

namespace FiveCardDraw\Entity\Hand;

/**
 * Class FiveOfAKind
 * @package FiveCardDraw\Entity\Hand
 */
class FiveOfAKind implements IHand
{
    /**
     * @var string
     */
    protected $rank;

    /**
     * FiveOfAKind constructor.
     * @param string $rank
     */
    public function __construct(string $rank)
    {
        $this->rank = $rank;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return self::HAND_FIVE_OF_A_KIND;
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
        return "Five of a kind: {$this->rank}s!";
    }
}