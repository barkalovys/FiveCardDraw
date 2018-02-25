<?php

namespace FiveCardDraw\Service\HandAnalyser;

use FiveCardDraw\Entity\Card\ICard;

class HandAnalyserService
{

    const REQUIRED_CARDS_NUMBER = 5;

    const RANK_STRENGTH = [
        ICard::RANK_DEUCE   => 2,
        ICard::RANK_THREE   => 3,
        ICard::RANK_FOUR    => 4,
        ICard::RANK_FIVE    => 5,
        ICard::RANK_SIX     => 6,
        ICard::RANK_SEVEN   => 7,
        ICard::RANK_EIGHT   => 8,
        ICard::RANK_NINE    => 9,
        ICard::RANK_TEN     => 10,
        ICard::RANK_JACK    => 11,
        ICard::RANK_QUEEN   => 12,
        ICard::RANK_KING    => 13,
        ICard::RANK_ACE     => 14,
    ];

    /**
     * @param \SplObjectStorage $hand
     */
    public function getCombinationByHand(\SplObjectStorage $hand)
    {
        if (count($hand) !== self::REQUIRED_CARDS_NUMBER) {
            throw new \InvalidArgumentException(
                "Hand should contain exactly " . self::REQUIRED_CARDS_NUMBER . " cards, " . count($hand) . " given."
            );
        }

        /** @var ICard $highestRankCard */
        $highestRankCard = null;
        $sameRankCards = [];
        $sameSuitCards = [];
        /** @var ICard $card */
        foreach ($hand as $card) {
            $sameRankCards[$card->getRank()] = $card;
            $sameSuitCards[$card->getSuit()] = $card;
            if (is_null($highestRankCard) ||
                (self::RANK_STRENGTH[$card->getRank()] > self::RANK_STRENGTH[$highestRankCard->getRank()])) {
                $highestRankCard = $card;
            }
        }
    }

}