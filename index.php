<?php

require_once 'vendor/autoload.php';

$players = new \FiveCardDraw\Entity\Player\PlayerList(5);
$deck = (new \FiveCardDraw\Service\Deck\StandardDeckBuilder())->build();
$game = new \FiveCardDraw\Entity\Game\FiveCardDraw\FiveCardDraw($deck, $players);
$game->play();