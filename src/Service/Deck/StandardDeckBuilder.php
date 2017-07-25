<?php

namespace Service\Deck;

use Entity\Card\Card;
use Entity\Deck\Deck;
use Entity\Deck\IDeck;
use Entity\Rank\IRank;
use Entity\Suit\ISuit;
use Service\Rank\RankFactory;
use Service\Suit\SuitFactory;

/**
 * Class StandardDeckBuilder
 * @package Service\Deck
 */
class StandardDeckBuilder implements IDeckBuilder
{
    /**
     * @var array
     */
    private $availableRanks = [
        IRank::RANK_DEUCE,
        IRank::RANK_THREE,
        IRank::RANK_FOUR,
        IRank::RANK_FIVE,
        IRank::RANK_SIX,
        IRank::RANK_SEVEN,
        IRank::RANK_EIGHT,
        IRank::RANK_NINE,
        IRank::RANK_TEN,
        IRank::RANK_JACK,
        IRank::RANK_QUEEN,
        IRank::RANK_KING,
        IRank::RANK_ACE,
    ];

    /**
     * @var array
     */
    private $availableSuits = [
        ISuit::SUIT_SPADES,
        ISuit::SUIT_HEARTS,
        ISuit::SUIT_DIAMONDS,
        ISuit::SUIT_CLUBS,
    ];

    /**
     * @return IDeck
     */
    public function build(): IDeck
    {
        $cards = [];
        $ranks = $this->getAvailableRanks();
        $suits = $this->getAvailableSuits();
        foreach ($ranks as $rankName) {
            $rank = RankFactory::getRank($rankName);
            foreach ($suits as $suitName) {
                $suit = SuitFactory::getSuit($suitName);
                $cards[] = new Card($rank, $suit);
            }
        }
        shuffle($cards);
        $deck = new Deck();
        foreach ($cards as $card) {
            $deck->push($card);
        }
        return $deck;
    }

    /**
     * @return array
     */
    public function getAvailableRanks(): array
    {
        return $this->availableRanks;
    }

    /**
     * @return array
     */
    public function getAvailableSuits(): array
    {
        return $this->availableSuits;
    }
}