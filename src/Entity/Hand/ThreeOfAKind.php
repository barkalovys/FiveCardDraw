<?php

namespace FiveCardDraw\Entity\Hand;

use FiveCardDraw\Entity\Card\ICard;

/**
 * Class ThreeOfAKind
 * @package FiveCardDraw\Entity\Hand
 */
class ThreeOfAKind implements IHand
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
     * ThreeOfAKind constructor.
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
        return IHand::HAND_THREE_OF_A_KIND;
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
        return "Three of a kind: {$this->rank}s with {$this->kicker->getRank()} kicker";
    }

    /**
     * @return ICard
     */
    public function getKicker(): ICard
    {
        return $this->kicker;
    }

}