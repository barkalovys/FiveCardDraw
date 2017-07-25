<?php

namespace Entity\Rank;


/**
 * Class Queen
 * @package Entity\Rank
 */
class Queen implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_QUEEN;
    }
}