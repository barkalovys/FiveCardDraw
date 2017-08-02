<?php

spl_autoload_register(function($className)
{
    $namespace = str_replace("\\","/",__NAMESPACE__);
    $className = str_replace("\\","/",$className);
    $class = __DIR__ . "/src/" . (empty($namespace) ? "" : $namespace . "/") . "{$className}.php";
    include_once($class);
});

$players = new \Entity\Player\PlayerList(5);
$game = new \Entity\Game\FiveCardDraw\FiveCardDraw(new \Service\Deck\StandardDeckBuilder(), $players);
$game->play();

$event = new \Event\PlayerEvent();
var_dump((new \Event\Listener\PlayerEventListener())->handle($event));