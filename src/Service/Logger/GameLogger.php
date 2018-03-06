<?php

namespace FiveCardDraw\Service\Logger;

use FiveCardDraw\Event\Listener\IEventListener;
use FiveCardDraw\Event\PlayerBetEvent;
use FiveCardDraw\Event\PlayerWinPotEvent;

/**
 * Class GameLogger
 * @package FiveCardDraw\Service\Logger
 */
class GameLogger implements ILogger, IEventListener
{

    /**
     * @param PlayerBetEvent $event
     */
    public function onPlayerBet(PlayerBetEvent $event)
    {
        $this->log("Player {$event->getPlayer()->getName()} bets {$event->getBet()}$");
    }

    /**
     * @param PlayerWinPotEvent $event
     */
    public function onPlayerWinPot(PlayerWinPotEvent $event)
    {
        $this->log("Player {$event->getPlayer()->getName()} wins pot {$event->getPot()}$ with hand: {$event->getPlayer()->getHand()}");
        $this->log(PHP_EOL);
    }

    /**
     * @param string $text
     */
    public function log(string $text)
    {
        echo $text . PHP_EOL;
    }
}