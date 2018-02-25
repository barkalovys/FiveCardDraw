<?php

namespace FiveCardDraw\Entity\Player;

interface IPlayer
{
    public function getName(): string ;

    public function getMoney(): int;

    public function bet(int $money);

    public function getHand(): \SplObjectStorage;
}