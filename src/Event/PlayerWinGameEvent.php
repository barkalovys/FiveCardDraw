<?php

namespace FiveCardDraw\Event;

use FiveCardDraw\Entity\Player\IPlayer;

class PlayerWinGameEvent implements IEvent
{

    /**
     * @var IPlayer
     */
    protected $player;


    /**
     * @param IPlayer $player
     */
    public function __construct(IPlayer $player)
    {
        $this->player = $player;
    }

    /**
     * @return IPlayer
     */
    public function getPlayer(): IPlayer
    {
        return $this->player;
    }
}