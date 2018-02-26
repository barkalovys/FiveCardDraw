<?php

namespace FiveCardDraw\Entity\Hand;

use FiveCardDraw\Entity\Card\ICard;

/**
 * Class TwoPair
 * @package FiveCardDraw\Entity\Hand
 */
class TwoPair implements IHand
{

    /**
     * @var ICard
     */
    private $kicker;

    /**
     * @var string
     */
    private $rankFirstPair;

    /**
     * @var string
     */
    private $rankSecondPair;

    /**
     * TwoPair constructor.
     * @param ICard $kicker
     * @param string $rankFirstPair
     * @param string $rankSecondPair
     */
    public function __construct(ICard $kicker, string $rankFirstPair, string $rankSecondPair)
    {
        $this->kicker = $kicker;
        $this->rankFirstPair = $rankFirstPair;
        $this->rankSecondPair = $rankSecondPair;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return IHand::HAND_TWO_PAIR;
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
        return "Two pairs: {$this->rankFirstPair}s and {$this->rankSecondPair}s with {$this->kicker->getRank()} kicker";
    }
}