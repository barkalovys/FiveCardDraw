<?php

namespace Entity\Suit;


/**
 * Class Diamonds
 * @package Entity\Suit
 */
class Diamonds implements ISuit
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::SUIT_DIAMONDS;
    }

}