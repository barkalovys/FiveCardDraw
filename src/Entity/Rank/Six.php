<?php

namespace Entity\Rank;


/**
 * Class Six
 * @package Entity\Rank
 */
class Six implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_SIX;
    }
}