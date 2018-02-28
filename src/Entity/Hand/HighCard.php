<?php

namespace FiveCardDraw\Entity\Hand;

use FiveCardDraw\Entity\Card\ICard;

/**
 * Class HighCard
 * @package FiveCardDraw\Entity\Hand
 */
class HighCard implements IHand
{

    /**
     * @var ICard
     */
    private $card;

    /**
     * HighCard constructor.
     * @param ICard $card
     */
    public function __construct(ICard $card)
    {
        $this->card = $card;
    }

    /**
     * @return int
     */
    public function getStrength(): int
    {
        return IHand::HAND_HIGH_CARD;
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
        return "High card {$this->card->getRank()} of {$this->card->getSuit()}";
    }

    /**
     * @return ICard
     */
    public function getCard(): ICard
    {
        return $this->card;
    }


}