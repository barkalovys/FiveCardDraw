<?php


namespace FiveCardDraw\Entity\Player;


/**
 * Interface IPlayerList
 * @package FiveCardDraw\Entity\Player
 */
interface IPlayerList
{
    /**
     * @param $player
     * @param $priority
     */
    public function attach(IPlayer $player);

    /**
     * @param $player
     */
    public function detach(IPlayer $player);

    /**
     * @param int $pos
     * @return IPlayer
     */
    public function getByPosition(int $pos): IPlayer;

    /**
     * @return array
     */
    public function getPlayers(): array;
}