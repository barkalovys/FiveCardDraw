<?php

namespace Entity\Rank;


/**
 * Class Five
 * @package Entity\Rank
 */
class Five implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_FIVE;
    }
}