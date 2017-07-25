<?php

namespace Entity\Rank;


/**
 * Class King
 * @package Entity\Rank
 */
class King implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_KING;
    }
}