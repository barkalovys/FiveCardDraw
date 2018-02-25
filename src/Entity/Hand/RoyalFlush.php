<?php

namespace FiveCardDraw\Entity\Hand;


class RoyalFlush implements IHand
{

    public function __construct(string $suit)
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