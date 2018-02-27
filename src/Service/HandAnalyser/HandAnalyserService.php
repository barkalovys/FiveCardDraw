<?php

namespace FiveCardDraw\Service\HandAnalyser;

use FiveCardDraw\Entity\Card\ICard;
use FiveCardDraw\Entity\Hand\FiveOfAKind;
use FiveCardDraw\Entity\Hand\FourOfAKind;
use FiveCardDraw\Entity\Hand\FullHouse;
use FiveCardDraw\Entity\Hand\CardsInfo;
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
        IHand::HAND_ROYAL_FLUSH => 10,
        IHand::HAND_FIVE_OF_A_KIND => 11,
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
        $info = $this->getInfo($cards);
        $sameRankCards = $info->getSameRankCards();
        $sameSuitCards = $info->getSameSuitCards();
        $maxSameRankCount = $info->getMaxSameRankCount();
        $maxSameRank = $info->getMaxSameRank();
        $secondMaxSameRankCount = $info->getSecondMaxSameRankCount();
        $secondMaxSameRank = $info->getSecondMaxSameRank();
        $consecutiveCardsCount = $info->getConsecutiveCardsCount();
        $differentRanksCount = count($sameRankCards);
        $differentSuitsCount = count($sameSuitCards);
        if (isset($sameRankCards[ICard::RANK_JOKER])) {
            $differentRanksCount = $differentRanksCount - count($sameRankCards[ICard::RANK_JOKER]);
            //TODO: check for joker color
            $differentSuitsCount = $differentSuitsCount - count($sameRankCards[ICard::RANK_JOKER]);
            $consecutiveCardsCount = $consecutiveCardsCount + count($sameRankCards[ICard::RANK_JOKER]);
        }
        switch ($differentRanksCount) {
            //Five of a kind
            case 0:
            case 1:
                $rank = array_pop(
                            array_keys(
                                array_filter(
                                    $sameRankCards,
                                    function($rank){
                                        return $rank !== ICard::RANK_JOKER;
                                    },
                                    ARRAY_FILTER_USE_KEY
                                )
                            )
                );
                if (empty($rank)) {
                    throw new \Exception('Error during rank calculation');
                }
                return new FiveOfAKind($rank);
            //Four of a kind or Full house
            case 2:
                if (
                    $maxSameRankCount === 4 ||
                    (isset($sameRankCards[ICard::RANK_JOKER]) && ($maxSameRankCount === (4 - count($sameRankCards[ICard::RANK_JOKER]))))
                ) {
                    $kicker = array_pop(array_filter($sameRankCards, function($rank) use ($maxSameRank){
                        return ($rank !== ICard::RANK_JOKER) && ($rank !== $maxSameRank);
                    }, ARRAY_FILTER_USE_KEY));
                    if (!$kicker instanceof ICard) {
                        throw new \UnexpectedValueException("Unexpected type of kicker: ".var_export($kicker, true) . ", ICard expected.");
                    }
                    return new FourOfAKind($kicker, $maxSameRank);
                }
                //Now it's definitely a FullHouse
                $threeCardsRank = $maxSameRank;
                $pairRank = $secondMaxSameRank;
                if ($maxSameRankCount === $secondMaxSameRankCount) {
                    //There is a Joker, so add it to the highest rank pair to make it triple
                    if (self::RANK_STRENGTH[$maxSameRank] < self::RANK_STRENGTH[$secondMaxSameRank]) {
                        $threeCardsRank = $secondMaxSameRank;
                        $pairRank = $maxSameRank;
                    }
                }
                return new FullHouse($threeCardsRank, $pairRank);
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
                break;
            // High card
            default:
                break;

        }
    }

    /**
     * @param array $cards
     * @return CardsInfo
     */
    private function getInfo(array $cards):CardsInfo
    {
        $this->sortCardsByRank($cards);
        $info = new CardsInfo($cards);
        $sameRankCards = [];
        $sameSuitCards = [];
        $maxSameRankCount       = 0;
        $secondMaxSameRankCount = 0;
        $maxSameRank        = '';
        $secondMaxSameRank  = '';
        $consecutiveCardsCount = 1;
        $previousCard = null;
        /** @var ICard $card */
        foreach ($cards as $card) {
            $rankStrength = self::RANK_STRENGTH[$card->getRank()];
            //TODO: check for gutshot (example: 5, 6, 8, 9, 10)
            if (!is_null($previousCard) &&
                ($rankStrength - self::RANK_STRENGTH[$previousCard->getRank()]) === 1) {
                $consecutiveCardsCount++;
            }
            $sameRankCards[$card->getRank()][] = $card;
            $count = count($sameRankCards[$card->getRank()]);
            if ($count > $maxSameRankCount) {
                $maxSameRankCount = $count;
                $maxSameRank = $card->getRank();
            } elseif ($count >= $secondMaxSameRankCount) {
                $secondMaxSameRankCount = $count;
                $secondMaxSameRank = $card->getRank();
            }
            $sameSuitCards[$card->getSuit()][] = $card;
            $previousCard = $card;
        }
        $info
            ->setSameRankCards($sameRankCards)
            ->setSameSuitCards($sameSuitCards)
            ->setMaxSameRankCount($maxSameRankCount)
            ->setSecondMaxSameRankCount($secondMaxSameRankCount)
            ->setMaxSameRank($maxSameRank)
            ->setSecondMaxSameRank($secondMaxSameRank)
            ->setConsecutiveCardsCount($consecutiveCardsCount);
        return $info;
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