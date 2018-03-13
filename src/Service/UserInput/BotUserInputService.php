<?php

namespace FiveCardDraw\Service\UserInput;

use FiveCardDraw\Entity\Player\IPlayer;
use FiveCardDraw\Entity\State\TradeState;

class BotUserInputService extends AbstractUserInputService
{
    /**
     * @var BotUserInputService
     */
    protected static $instance;

    /**
     * @param IPlayer $player
     * @param TradeState $state
     * @return float
     */
    public function inputBet(IPlayer $player, TradeState $state)
    {
        $minBet = $state->getMaxStake() - $player->getCurrentBet();
        $money = $player->getMoney();
        if ($minBet > 0 && rand(0, 9)) {
            //call
            $bet = $money > $minBet ? $minBet : $money;
        } else {
            //raise
            $bet = ($money - abs($minBet)) > 15 ? rand(abs($minBet), (int)$money) : $money;
        }
        return $bet;
    }
}