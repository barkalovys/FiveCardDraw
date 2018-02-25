<?php

namespace FiveCardDraw\Entity\Hand;

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

    public function getStrength(): int
    {
        return self::HAND_FIVE_OF_A_KIND;
    }

    public function getName():int
    {
        // TODO: Implement getName() method.
    }

    public function __toString()
    {
        return '';
    }
}