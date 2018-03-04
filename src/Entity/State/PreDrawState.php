<?php

namespace FiveCardDraw\Entity\State;


use FiveCardDraw\Entity\Game\IGame;
use FiveCardDraw\Entity\Player\IPlayer;

/**
 * Class PreDrawState
 * @package Entity\State
 */
class PreDrawState implements IState
{
    /**
     * @var IGame
     */
    protected $game;

    /**
     * @param IGame $game
     */
    public function __construct(IGame $game)
    {
        $this->game = $game;
    }

    /**
     * Give cards to each player and post blinds
     */
    public function play()
    {
        for ($i = 0; $i < 5; ++$i) {
            /** @var IPlayer $player */
            foreach ($this->getGame()->getPlayers() as $player) {
                if ($i === 0){
                    if ($player->getPosition() === 0) {
                        $player
                            ->setStatus(IPlayer::TRADE_STATUS_WAITING)
                            ->bet($this->getGame()->getSmallBlindBet());
                    } elseif ($player->getPosition() === 1) {
                        $player
                            ->setStatus(IPlayer::TRADE_STATUS_BETTING)
                            ->bet(2 * $this->getGame()->getSmallBlindBet());
                    } else {
                        $player->setStatus(IPlayer::TRADE_STATUS_WAITING);
                    }
                }
                $player->addCard($this->getGame()->getDeck()->draw());
            }
        }
        $this->getGame()->changeState(new TradeState($this->getGame()));
    }

    /**
     * @return IGame
     */
    public function getGame(): IGame
    {
        return $this->game;
    }
}