<?php

namespace Entity\State;


use Entity\Game\IGame;

/**
 * Interface IState
 * @package Entity\State
 */
interface IState
{

    public function play();

    /**
     * @return IGame
     */
    public function getGame(): IGame;
}