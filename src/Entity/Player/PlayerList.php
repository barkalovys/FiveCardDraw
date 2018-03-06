<?php

namespace FiveCardDraw\Entity\Player;
use FiveCardDraw\Event\Listener\IEventListener;
use FiveCardDraw\Event\PlayerWinPotEvent;

/**
 * Class PlayerList
 * @package Entity\Player
 */
class PlayerList implements IPlayerList, IEventListener
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
     * @param PlayerWinPotEvent $event
     */
    public function onPlayerWinPot(PlayerWinPotEvent $event)
    {
        foreach ($this->players as $player) {
            if ($player !== $event->getPlayer() && $player->getMoney() == 0) {
                $this->detach($player);
            }
        }
    }

    /**
     * @param IPlayer $player
     */
    public function attach(IPlayer $player)
    {
        $this->players[$player->getId()] = $player;
        $this->refreshPositions();
    }

    /**
     * @param IPlayer $player
     */
    public function detach(IPlayer $player)
    {
        unset($this->players[$player->getId()]);
        $this->refreshPositions();
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

    private function refreshPositions()
    {
        $i = 0;
        /** @var IPlayer $player */
        foreach ($this->getPlayers() as $player) {
            $player->setPosition($i);
            ++$i;
        }
    }

    private function sortByPosition()
    {

    }

    /**
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

}