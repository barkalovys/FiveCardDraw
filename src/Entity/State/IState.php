<?php

namespace FiveCardDraw\Entity\State;


use FiveCardDraw\Entity\Game\IGame;

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