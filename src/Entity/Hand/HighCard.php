<?php

namespace FiveCardDraw\Entity\Hand;

use FiveCardDraw\Entity\Card\ICard;

class HighCard implements IHand
{

    public function __construct(ICard $card)
    {

    }

    public function getStrength(): int
    {
        // TODO: Implement getStrength() method.
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