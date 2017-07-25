<?php


namespace Entity\Suit;


/**
 * Interface ISuit
 * @package Entity\Suit
 */
interface ISuit
{
    const SUIT_SPADES = 'spades';

    const SUIT_CLUBS = 'clubs';

    const SUIT_HEARTS = 'hearts';

    const SUIT_DIAMONDS = 'diamonds';

    /**
     * @return string
     */
    public function __toString(): string;
}