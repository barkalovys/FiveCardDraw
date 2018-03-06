<?php

namespace FiveCardDraw\Entity\Player;

/**
 * Class PlayerList
 * @package Entity\Player
 */
class PlayerList implements IPlayerList
{

    /**
     * @var array
     */
    protected $players = [];

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
     */
    public function attach(IPlayer $player)
    {
        $this->players[$player->getId()] = $player;
    }

    /**
     * @param IPlayer $player
     */
    public function detach(IPlayer $player)
    {
        unset($this->players[$player->getId()]);
    }

    /**
     * @param int $pos
     * @return IPlayer|null
     */
    public function getByPosition(int $pos): IPlayer
    {
        /** @var IPlayer $player */
        foreach ($this->players as $player) {
            if ($player->getPosition() === $pos) {
                return $player;
            }
        }
        return null;
    }

    /**
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }


}