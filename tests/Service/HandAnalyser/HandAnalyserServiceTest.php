<?php

namespace FiveCardDraw\Service\HandAnalyser;

use FiveCardDraw\Entity\Card\Card;
use FiveCardDraw\Entity\Card\ICard;
use FiveCardDraw\Entity\Hand\FiveOfAKind;
use FiveCardDraw\Entity\Hand\Flush;
use FiveCardDraw\Entity\Hand\FourOfAKind;
use FiveCardDraw\Entity\Hand\FullHouse;
use FiveCardDraw\Entity\Hand\HighCard;
use FiveCardDraw\Entity\Hand\IHand;
use FiveCardDraw\Entity\Hand\Pair;
use FiveCardDraw\Entity\Hand\RoyalFlush;
use FiveCardDraw\Entity\Hand\Straight;
use FiveCardDraw\Entity\Hand\StraightFlush;
use FiveCardDraw\Entity\Hand\ThreeOfAKind;
use FiveCardDraw\Entity\Hand\TwoPair;
use PHPUnit\Framework\TestCase;

/**
 * Class HandAnalyserServiceTest
 * @package FiveCardDraw\Service\HandAnalyser
 */
class HandAnalyserServiceTest extends TestCase
{

    /**
     * @var HandAnalyserService
     */
    private $service;

    public function __construct(string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->service = new HandAnalyserService();
    }

    public function testDetectsHighCardIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_EIGHT, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_SIX, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_NINE, ICard::SUIT_SPADES),
            new Card(ICard::RANK_FOUR, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_QUEEN, ICard::SUIT_HEARTS),
        ];
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(HighCard::class, $hand);
        /** @var HighCard $hand */
        $this->assertEquals(ICard::RANK_QUEEN, $hand->getCard()->getRank());
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
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(Pair::class, $hand);
        /** @var Pair $hand */
        $this->assertEquals(ICard::RANK_SIX, $hand->getRank());
        $this->assertEquals(ICard::RANK_QUEEN, $hand->getKicker()->getRank());
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
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(TwoPair::class, $hand);
        $this->assertEquals(ICard::RANK_NINE, $hand->getKicker()->getRank());
    }

    public function testDetectsThreeOfAKindIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_EIGHT, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_EIGHT, ICard::SUIT_SPADES),
            new Card(ICard::RANK_NINE, ICard::SUIT_SPADES),
            new Card(ICard::RANK_FOUR, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_EIGHT, ICard::SUIT_HEARTS),
        ];
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(ThreeOfAKind::class, $hand);
        $this->assertEquals(ICard::RANK_NINE, $hand->getKicker()->getRank());
    }

    public function testDetectsStraightIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_SEVEN, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_EIGHT, ICard::SUIT_HEARTS),
            new Card(ICard::RANK_NINE, ICard::SUIT_SPADES),
            new Card(ICard::RANK_JACK, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_TEN, ICard::SUIT_HEARTS),
        ];
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(Straight::class, $hand);
    }

    public function testDetectsFlushIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_SEVEN, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_EIGHT, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_NINE, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_KING, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_TEN, ICard::SUIT_CLUBS),
        ];
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(Flush::class, $hand);
        $this->assertEquals(ICard::RANK_KING, $hand->getHighcard()->getRank());
    }

    public function testDetectsFullHouseIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_EIGHT, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_EIGHT, ICard::SUIT_SPADES),
            new Card(ICard::RANK_FOUR, ICard::SUIT_SPADES),
            new Card(ICard::RANK_FOUR, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_EIGHT, ICard::SUIT_HEARTS),
        ];
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(FullHouse::class, $hand);
    }

    public function testDetectsFourOfAKindIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_DEUCE, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_DEUCE, ICard::SUIT_SPADES),
            new Card(ICard::RANK_DEUCE, ICard::SUIT_HEARTS),
            new Card(ICard::RANK_DEUCE, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_FIVE, ICard::SUIT_HEARTS),
        ];
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(FourOfAKind::class, $hand);
        $this->assertEquals(ICard::RANK_FIVE, $hand->getKicker()->getRank());
    }

    public function testDetectsStraightFlushIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_SEVEN, ICard::SUIT_HEARTS),
            new Card(ICard::RANK_EIGHT, ICard::SUIT_HEARTS),
            new Card(ICard::RANK_NINE, ICard::SUIT_HEARTS),
            new Card(ICard::RANK_JACK, ICard::SUIT_HEARTS),
            new Card(ICard::RANK_TEN, ICard::SUIT_HEARTS),
        ];
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(StraightFlush::class, $hand);
    }

    public function testDetectsRoyalFlushIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_KING, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_JACK, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_TEN, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_ACE, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_QUEEN, ICard::SUIT_DIAMONDS),
        ];
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(RoyalFlush::class, $hand);
    }

    public function testDetectsFiveOfAKindIsCorrect()
    {
        $cards = [
            new Card(ICard::RANK_KING, ICard::SUIT_HEARTS),
            new Card(ICard::RANK_KING, ICard::SUIT_SPADES),
            new Card(ICard::RANK_KING, ICard::SUIT_CLUBS),
            new Card(ICard::RANK_KING, ICard::SUIT_DIAMONDS),
            new Card(ICard::RANK_JOKER, ICard::SUIT_DIAMONDS),
        ];
        $hand = $this->getService()->getHand($cards);
        $this->assertInstanceOf(FiveOfAKind::class, $hand);
    }

    /**
     * @return HandAnalyserService
     */
    public function getService(): HandAnalyserService
    {
        return $this->service;
    }
    
}