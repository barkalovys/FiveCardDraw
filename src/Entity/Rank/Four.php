<?php

namespace Entity\Rank;


/**
 * Class Four
 * @package Entity\Rank
 */
class Four implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_FOUR;
    }
}