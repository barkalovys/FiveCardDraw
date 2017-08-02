<?php

namespace Entity\Game;


use Entity\Deck\IDeck;
use Entity\Player\IPlayerList;
use Entity\State\IState;

/**
 * Interface IGame
 * @package Entity\Game
 */
interface IGame
{
    /**
     * @return mixed
     */
    public function play();

    /**
     * @param IState $state
     */
    public function changeState(IState $state);

    public function getPlayers(): IPlayerList;

    public function getDeck(): IDeck;
}