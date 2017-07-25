<?php

namespace Entity\Rank;


/**
 * Class Jack
 * @package Entity\Rank
 */
class Jack implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_JACK;
    }
}