<?php

namespace FiveCardDraw\Entity\Deck;


use FiveCardDraw\Entity\Card\ICard;

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