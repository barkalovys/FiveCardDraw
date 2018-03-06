<?php

namespace FiveCardDraw\Event;

use FiveCardDraw\Entity\Player\IPlayer;

class PlayerBetEvent implements IEvent
{

    /**
     * @var IPlayer
     */
    protected $player;

    /**
     * @var float
     */
    protected $bet;

    /**
     * @param IPlayer $player
     */
    public function __construct(IPlayer $player, float $bet)
    {
        $this->player = $player;
        $this->bet = $bet;
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
    public function getBet(): float
    {
        return $this->bet;
    }

}