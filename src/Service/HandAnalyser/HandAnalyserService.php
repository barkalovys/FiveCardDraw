<?php

namespace FiveCardDraw\Service\HandAnalyser;

use FiveCardDraw\Entity\Card\ICard;
use FiveCardDraw\Entity\Game\FiveCardDraw\FiveCardDraw;
use FiveCardDraw\Entity\Hand\IHand;

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

    const HANDS_STRENGTH = [
        IHand::HAND_HIGH_CARD => 1,
        IHand::HAND_ONE_PAIR => 2,
        IHand::HAND_TWO_PAIR => 3,
        IHand::HAND_THREE_OF_A_KIND => 4,
        IHand::HAND_STRAIGHT => 5,
        IHand::HAND_FLUSH => 6,
        IHand::HAND_FULL_HOUSE => 7,
        IHand::HAND_FOUR_OF_A_KIND => 8,
        IHand::HAND_STRAIGHT_FLUSH => 9,
        IHand::HAND_FIVE_OF_A_KIND => 10,
    ];

    /**
     * @param array $cards
     * @return IHand
     */
    public function getHandStrength(array $cards)
    {
        if (count($cards) !== self::REQUIRED_CARDS_NUMBER) {
            throw new \InvalidArgumentException(
                "Hand should contain exactly " . self::REQUIRED_CARDS_NUMBER . " cards, " . count($cards) . " given."
            );
        }
        $info = $this->getCardsInfo($cards);
        $sameRankCards = $info['sameRankCards'];
        $sameSuitCards = $info['sameSuitCards'];
        $consecutiveCardsCount = $info['consecutiveCardsCount'];
        $differentRanksCount = count($sameRankCards);
        $differentSuitsCount = count($sameSuitCards);

        $handName = '';
        /** @var ICard $highestRankCard */
        $highestRankCard = null;
        $kicker = null;
        switch ($differentRanksCount) {
            //Four/Five of a kind or Full house
            case 2:
                /**@var array $cc  */
                foreach ($sameRankCards as $rank => $cc) {
                    if (count($cc) === 4) {
                        $handName = isset($sameRankCards[ICard::RANK_JOKER]) ?
                            IHand::HAND_FIVE_OF_A_KIND :
                            IHand::HAND_FOUR_OF_A_KIND;
                    }
                }
                break;
            //Three of a kind or Two pairs
            case 3:
                break;
            //Pair
            case 4:
                break;
            case 5:
                //Royal flush or Straight flush or Straight
                if ($consecutiveCardsCount === 5) {
                    break;
                }
                // Flush
                elseif ($differentSuitsCount === 1) {
                    break;
                }
            // High card
            default:
                break;

        }
    }

    /**
     * @param array $cards
     * @return array info => [
     *      'sameRankCards' => array of ICard,
     *      'sameSuitCards' => array of ICard,
     *      'consecutiveCardsCount' => int,
     * ]
     */
    private function getCardsInfo(array $cards)
    {
        $this->sortCardsByRank($cards);
        $sameRankCards = [];
        $sameSuitCards = [];
        $consecutiveCardsCount = 0;
        $previousCard = null;
        /** @var ICard $card */
        foreach ($cards as $card) {
            $rankStrength = self::RANK_STRENGTH[$card->getRank()];
            if (!is_null($previousCard) &&
                ($rankStrength - self::RANK_STRENGTH[$previousCard->getRank()]) === 1) {
                $consecutiveCardsCount++;
            }
            $sameRankCards[$card->getRank()][] = $card;
            $sameSuitCards[$card->getSuit()][] = $card;
            $previousCard = $card;
        }
        return [
            'sameRankCards' => $sameRankCards,
            'sameSuitCards' => $sameSuitCards,
            'consecutiveCardsCount' => $consecutiveCardsCount,
        ];
    }

    /**
     * @param array &$cards
     */
    private function sortCardsByRank(array &$cards)
    {
        /** Sort hand by rank */
        usort(
            $cards,
            /**@var ICard $c1 */
            /**@var ICard $c2 */
            function($c1, $c2) {
                $rank1 = self::RANK_STRENGTH[$c1->getRank()];
                $rank2 = self::RANK_STRENGTH[$c2->getRank()];
                if ($rank1 === $rank2) {
                    return 0;
                }
                return $rank1 > $rank2 ? 1 : -1;
            }
        );
    }
}