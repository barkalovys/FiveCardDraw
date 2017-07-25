<?php

namespace Entity\Suit;


/**
 * Class Spades
 * @package Entity\Suit
 */
class Spades implements ISuit
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::SUIT_SPADES;
    }
}