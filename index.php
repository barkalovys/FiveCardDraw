<?php

require_once 'vendor/autoload.php';

$players = new \FiveCardDraw\Entity\Player\PlayerList([
    'Player_1',
    'Player_2',
    'Player_3',
    'Player_4',
    'Player_5',
]);
$deck = (new \FiveCardDraw\Service\Deck\StandardDeckBuilder())->build();
$game = new \FiveCardDraw\Entity\Game\FiveCardDraw\FiveCardDraw($deck, $players);
$game->play();