<?php

namespace FiveCardDraw\Entity\Hand;

use FiveCardDraw\Entity\Card\ICard;

class FullHouse implements IHand
{

    public function __construct(ICard $kicker, string $rank)
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