<?php

namespace Entity\Deck;

use Entity\Card\ICard;
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