<?php

namespace FiveCardDraw\Service\Deck;

use FiveCardDraw\Entity\Deck\IDeck;

interface IDeckBuilder
{
    public function build(): IDeck;
}