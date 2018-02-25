<?php

namespace FiveCardDraw\Entity\Player;

use FiveCardDraw\Entity\Card\ICard;
use FiveCardDraw\Entity\Hand\IHand;

interface IPlayer
{
    public function getName(): string ;

    public function getMoney(): int;

    public function bet(int $money);

    public function getHand():IHand;

    public function setHand(IHand $hand):IPlayer;

    public function getCards():array;

    public function drawCard(ICard $card):IPlayer;
}