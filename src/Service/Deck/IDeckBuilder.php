<?php

namespace Service\Deck;

use Entity\Deck\IDeck;

interface IDeckBuilder
{
    public function build(): IDeck;
}