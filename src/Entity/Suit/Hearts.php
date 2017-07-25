<?php

namespace Entity\Suit;


/**
 * Class Hearts
 * @package Entity\Suit
 */
class Hearts implements ISuit
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return self::SUIT_HEARTS;
    }

}