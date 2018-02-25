<?php

namespace FiveCardDraw\Entity\Deck;

use FiveCardDraw\Entity\Card\ICard;
use SplStack;

/**
 * Class Deck
 * @package Entity\Deck
 */
class Deck extends SplStack implements IDeck
{

    /**
     * @return ICard
     */
    public function draw(): ICard
    {
        return $this->pop();
    }
}