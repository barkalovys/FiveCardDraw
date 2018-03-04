<?php

namespace FiveCardDraw\Entity\Player;

/**
 * Class PlayerList
 * @package Entity\Player
 */
class PlayerList extends \SplObjectStorage implements IPlayerList
{

    /**
     * PlayerList constructor.
     * @param int $numPlayers
     * @throws \Exception
     */
    public function __construct(int $numPlayers)
    {
        if ($numPlayers < 1 || $numPlayers > 10) {
            throw new \Exception("Players number must be between 0 and 10, {$numPlayers} given");
        }

        for ($i = 1; $i <= $numPlayers; ++$i) {
            $this->attach(new Player('Player_' . $i, rand(100, 500), $i-1), $i);
        }
    }

    /**
     * @param IPlayer $player
     * @param int $priority
     * @throws \Exception
     */
    public function attach($player, $priority = null)
    {
        if (!$player instanceof IPlayer) {
            throw new \Exception('Player must be type of Entity\Player\IPlayer');
        }
        parent::attach($player, $priority);
    }
}