<?php

namespace Entity\Rank;


/**
 * Class Nine
 * @package Entity\Rank
 */
class Nine implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_NINE;
    }
}