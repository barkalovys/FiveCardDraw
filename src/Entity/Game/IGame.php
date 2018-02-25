<?php

namespace FiveCardDraw\Entity\Game;


use FiveCardDraw\Entity\Deck\IDeck;
use FiveCardDraw\Entity\Player\IPlayerList;
use FiveCardDraw\Entity\State\IState;

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