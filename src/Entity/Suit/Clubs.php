<?php

namespace Entity\Suit;


/**
 * Class Clubs
 * @package Entity\Suit
 */
class Clubs implements ISuit
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::SUIT_CLUBS;
    }

}