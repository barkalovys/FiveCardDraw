<?php

namespace FiveCardDraw\Service\Deck;

use FiveCardDraw\Entity\Card\Card;
use FiveCardDraw\Entity\Card\ICard;
use FiveCardDraw\Entity\Deck\Deck;
use FiveCardDraw\Entity\Deck\IDeck;

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
        ICard::RANK_DEUCE,
        ICard::RANK_THREE,
        ICard::RANK_FOUR,
        ICard::RANK_FIVE,
        ICard::RANK_SIX,
        ICard::RANK_SEVEN,
        ICard::RANK_EIGHT,
        ICard::RANK_NINE,
        ICard::RANK_TEN,
        ICard::RANK_JACK,
        ICard::RANK_QUEEN,
        ICard::RANK_KING,
        ICard::RANK_ACE,
    ];

    /**
     * @var array
     */
    private $availableSuits = [
        ICard::SUIT_SPADES,
        ICard::SUIT_HEARTS,
        ICard::SUIT_DIAMONDS,
        ICard::SUIT_CLUBS,
    ];

    /**
     * @return IDeck
     */
    public function build(): IDeck
    {
        $cards = [];
        foreach ($this->getAvailableRanks() as $rank) {
            foreach ($this->getAvailableSuits() as $suit) {
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