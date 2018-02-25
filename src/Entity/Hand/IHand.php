<?php

namespace FiveCardDraw\Entity\Hand;

interface IHand
{

    const HAND_HIGH_CARD = 1;
    const HAND_ONE_PAIR = 2;
    const HAND_TWO_PAIR = 3;
    const HAND_THREE_OF_A_KIND = 4;
    const HAND_STRAIGHT = 5;
    const HAND_FLUSH = 6;
    const HAND_FULL_HOUSE = 7;
    const HAND_FOUR_OF_A_KIND = 8;
    const HAND_STRAIGHT_FLUSH = 9;
    const HAND_FIVE_OF_A_KIND = 10;

    public function getStrength():int;

    public function getName():int;

    public function __toString();
}