<?php

namespace Entity\Deck;


use Entity\Card\ICard;

/**
 * Interface IDeck
 * @package Entity\Deck
 */
interface IDeck
{

    /**
     * @return ICard
     */
    public function draw(): ICard;
}