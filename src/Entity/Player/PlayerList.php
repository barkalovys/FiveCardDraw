<?php

namespace FiveCardDraw\Entity\Player;
use FiveCardDraw\Event\Listener\IEventListener;
use FiveCardDraw\Event\PlayerWinRoundEvent;

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
     * @param array $players
     * @throws \Exception
     */
    public function __construct(array $players = [])
    {
        for ($i = 0; $i < count($players); ++$i) {
            $this->attach(new Player($players[$i], rand(100, 500), $i, $i !== 0));
        }
    }


    /**
     * @param PlayerWinRoundEvent $event
     */
    public function onPlayerWinRound(PlayerWinRoundEvent $event)
    {
        $this->refreshPositions();
        $this->movePosition();
        $this->sortByPosition();
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

    public function movePosition()
    {
        /** @var IPlayer $player */
        foreach ($this->players as $player){
            $position = $player->getPosition();
            $newPosition = $position === (count($this->players) - 1) ? 0 : $position + 1;
            $player->setPosition($newPosition);
        }
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
        /** Sort hand by rank */
        uasort(
            $this->players,
            /**@var IPlayer $p1 */
            /**@var IPlayer $p2 */
            function($p1, $p2) {
                if ($p1->getPosition() === $p2->getPosition()) {
                    return 0;
                }
                return $p1->getPosition() > $p2->getPosition() ? 1 : -1;
            }
        );
    }

    /**
     * @return array
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

}