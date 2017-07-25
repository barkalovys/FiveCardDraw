<?php

namespace Entity\Card;

use Entity\Suit\ISuit;
use Entity\Rank\IRank;

/**
 * Interface ICard
 * @package Entity\Card
 */
interface ICard
{

    /**
     * ICard constructor.
     * @param IRank $rank
     * @param ISuit $suit
     */
    public function __construct(IRank $rank, ISuit $suit);

    /**
     * @return ISuit
     */
    public function getSuit(): ISuit;


    /**
     * @return IRank
     */
    public function getRank(): IRank;

    /**
     * @return string
     */
    public function __toString(): string;

}