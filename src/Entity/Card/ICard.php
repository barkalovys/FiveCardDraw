<?php

namespace FiveCardDraw\Entity\Card;

/**
 * Interface ICard
 * @package Entity\Card
 */
interface ICard
{
    const SUIT_SPADES = 'spades';

    const SUIT_CLUBS = 'clubs';

    const SUIT_HEARTS = 'hearts';

    const SUIT_DIAMONDS = 'diamonds';

    const RANK_DEUCE = 'deuce';

    const RANK_THREE = 'three';

    const RANK_FOUR = 'four';

    const RANK_FIVE = 'five';

    const RANK_SIX = 'six';

    const RANK_SEVEN = 'seven';

    const RANK_EIGHT = 'eight';

    const RANK_NINE = 'nine';

    const RANK_TEN = 'ten';

    const RANK_JACK = 'jack';

    const RANK_QUEEN = 'queen';

    const RANK_KING = 'king';

    const RANK_ACE = 'ace';

    const RANK_JOKER = 'joker';

    /**
     * ICard constructor.
     * @param string $rank
     * @param string $suit
     */
    public function __construct(string $rank, string $suit);

    /**
     * @return string
     */
    public function getSuit(): string;


    /**
     * @return string
     */
    public function getRank(): string;

    /**
     * @return string
     */
    public function __toString(): string;

}