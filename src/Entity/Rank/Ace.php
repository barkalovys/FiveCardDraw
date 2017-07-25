<?php

namespace Entity\Rank;


/**
 * Class Ace
 * @package Entity\Rank
 */
class Ace implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_ACE;
    }
}