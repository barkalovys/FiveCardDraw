<?php

namespace FiveCardDraw\Event;

use FiveCardDraw\Entity\Player\IPlayer;

class PlayerWinPotEvent implements IEvent
{

    /**
     * @var IPlayer
     */
    protected $player;

    /**
     * @var float
     */
    protected $pot;

    /**
     * @param IPlayer $player
     */
    public function __construct(IPlayer $player, float $pot)
    {
        $this->player = $player;
        $this->pot = $pot;
    }

    /**
     * @return IPlayer
     */
    public function getPlayer(): IPlayer
    {
        return $this->player;
    }

    /**
     * @return float
     */
    public function getPot(): float
    {
        return $this->pot;
    }

}