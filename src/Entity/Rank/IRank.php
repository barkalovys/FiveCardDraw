<?php


namespace Entity\Rank;


/**
 * Interface IRank
 * @package Entity\Rank
 */
interface IRank
{
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
     * @return string
     */
    public function __toString(): string;
}