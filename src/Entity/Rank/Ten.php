<?php

namespace Entity\Rank;


/**
 * Class Ten
 * @package Entity\Rank
 */
class Ten implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_TEN;
    }
}