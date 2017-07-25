<?php

namespace Entity\Rank;


/**
 * Class Three
 * @package Entity\Rank
 */
class Three implements IRank
{

    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::RANK_THREE;
    }
}