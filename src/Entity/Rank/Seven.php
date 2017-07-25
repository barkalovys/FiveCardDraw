<?php

namespace Entity\Rank;


/**
 * Class Seven
 * @package Entity\Rank
 */
class Seven implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_SEVEN;
    }
}