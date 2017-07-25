<?php

namespace Entity\Rank;


/**
 * Class Eight
 * @package Entity\Rank
 */
class Eight implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_EIGHT;
    }
}