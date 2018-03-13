<?php

namespace FiveCardDraw\Service\UserInput;

use FiveCardDraw\Entity\Player\IPlayer;
use FiveCardDraw\Entity\State\TradeState;

class CliUserInputService extends AbstractUserInputService
{
    /**
     * @var CliUserInputService
     */
    protected static $instance;

    /**
     * @param IPlayer $player
     * @param TradeState $state
     * @return float
     */
    public function inputBet(IPlayer $player, TradeState $state)
    {
        $game = $state->getGame();
        $logger = $game->getLogger();
        $pot = $game->getPot();
        $minBet = $state->getMaxStake() - $player->getCurrentBet();
        $message = "{$player->getName()} bet: ";
        $logger->log("Total in pot: $pot$");
        $logger->log("{$player->getName()} money: {$player->getMoney()}$");
        if ($minBet > 0) {
            $logger->log("To call bet $minBet$");
        }
        do {
            $isValidBet = true;
            $bet = readline($message);
            if (!is_numeric($bet)) {
                $message = "Bet must be numeric, try again: ";
                $isValidBet = false;
            }

            if ($bet < $minBet && $player->getMoney() > $bet) {
                $message = "You must bet at least $minBet to call, try again: ";
                $isValidBet = false;
            }

            if ($player->getMoney() < $bet) {
                $bet = $player->getMoney();
            }

        } while (!$isValidBet);
        return $bet;
    }
}