<?php

namespace FiveCardDraw\Service\HandAnalyser;

use FiveCardDraw\Entity\Card\Card;
use FiveCardDraw\Entity\Card\ICard;
use FiveCardDraw\Entity\Hand\HighCard;
use FiveCardDraw\Entity\Hand\IHand;
use FiveCardDraw\Entity\Hand\Pair;
use FiveCardDraw\Entity\Hand\ThreeOfAKind;
use FiveCardDraw\Entity\Hand\TwoPair;
use PHPUnit\Framework\TestCase;

/**
 * Class HandAnalyserServiceTest
 * @package FiveCardDraw\Service\HandAnalyser
 */
class HandAnalyserServiceTest extends TestCase
{

    public function testDetectsHighCardIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_EIGHT, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_SIX, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_NINE, ICard::SUIT_SPADES),
            new Card(ICard::RANK_FOUR, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_QUEEN, ICard::SUIT_HEARTS),
        ];
        $hand = (new HandAnalyserService())->getHand($cards);
        $this->assertInstanceOf(HighCard::class, $hand);
    }

    public function testDetectsPairIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_EIGHT, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_SIX, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_NINE, ICard::SUIT_SPADES),
            new Card(ICard::RANK_SIX, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_QUEEN, ICard::SUIT_HEARTS),
        ];
        $hand = (new HandAnalyserService())->getHand($cards);
        $this->assertInstanceOf(Pair::class, $hand);
    }

    public function testDetectsTwoPairIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_EIGHT, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_FOUR, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_NINE, ICard::SUIT_SPADES),
            new Card(ICard::RANK_FOUR, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_EIGHT, ICard::SUIT_HEARTS),
        ];
        $hand = (new HandAnalyserService())->getHand($cards);
        $this->assertInstanceOf(TwoPair::class, $hand);
    }

    public function testDetectsThreeOfAKindIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_EIGHT, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_EIGHT, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_NINE, ICard::SUIT_SPADES),
            new Card(ICard::RANK_FOUR, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_EIGHT, ICard::SUIT_HEARTS),
        ];
        $hand = (new HandAnalyserService())->getHand($cards);
        $this->assertInstanceOf(ThreeOfAKind::class, $hand);
    }


}