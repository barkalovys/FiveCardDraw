<?php

namespace Entity\Rank;


/**
 * Class Deuce
 * @package Entity\Rank
 */
class Deuce implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_DEUCE;
    }
}