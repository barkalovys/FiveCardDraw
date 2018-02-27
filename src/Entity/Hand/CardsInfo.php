<?php

namespace FiveCardDraw\Entity\Hand;


/**
 * Class CardsInfo
 * @package FiveCardDraw\Entity\Hand
 */
class CardsInfo
{

    /**
     * @var array
     */
    private $sameRankCards = [];

    /**
     * @var array
     */
    private $sameSuitCards = [];

    /**
     * @var int
     */
    private $maxSameRankCount = 0;

    /**
     * @var int
     */
    private $secondMaxSameRankCount = 0;

    /**
     * @var string
     */
    private $maxSameRank = '';

    /**
     * @var string
     */
    private $secondMaxSameRank = '';

    /**
     * @var int
     */
    private $consecutiveCardsCount = 0;

    /**
     * @var array
     */
    private $cards;

    /**
     * @param array $cards
     */
    public function __construct(array $cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return array
     */
    public function getSameRankCards():array
    {
        return $this->sameRankCards;
    }

    /**
     * @param array $sameRankCards
     * @return CardsInfo
     */
    public function setSameRankCards(array $sameRankCards)
    {
        $this->sameRankCards = $sameRankCards;
        return $this;
    }

    /**
     * @return array
     */
    public function getSameSuitCards():array
    {
        return $this->sameSuitCards;
    }

    /**
     * @param array $sameSuitCards
     * @return CardsInfo
     */
    public function setSameSuitCards(array $sameSuitCards)
    {
        $this->sameSuitCards = $sameSuitCards;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxSameRankCount():int
    {
        return $this->maxSameRankCount;
    }

    /**
     * @param int $maxSameRankCount
     * @return CardsInfo
     */
    public function setMaxSameRankCount(int $maxSameRankCount):CardsInfo
    {
        $this->maxSameRankCount = $maxSameRankCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getSecondMaxSameRankCount():int
    {
        return $this->secondMaxSameRankCount;
    }

    /**
     * @param int $secondMaxSameRankCount
     * @return CardsInfo
     */
    public function setSecondMaxSameRankCount(int $secondMaxSameRankCount):CardsInfo
    {
        $this->secondMaxSameRankCount = $secondMaxSameRankCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getMaxSameRank():string
    {
        return $this->maxSameRank;
    }

    /**
     * @param string $maxSameRank
     * @return CardsInfo
     */
    public function setMaxSameRank(string $maxSameRank):CardsInfo
    {
        $this->maxSameRank = $maxSameRank;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecondMaxSameRank():string
    {
        return $this->secondMaxSameRank;
    }

    /**
     * @param string $secondMaxSameRank
     * @return CardsInfo
     */
    public function setSecondMaxSameRank(string $secondMaxSameRank):CardsInfo
    {
        $this->secondMaxSameRank = $secondMaxSameRank;
        return $this;
    }

    /**
     * @return int
     */
    public function getConsecutiveCardsCount():int
    {
        return $this->consecutiveCardsCount;
    }

    /**
     * @param int $consecutiveCardsCount
     * @return CardsInfo
     */
    public function setConsecutiveCardsCount(int $consecutiveCardsCount):CardsInfo
    {
        $this->consecutiveCardsCount = $consecutiveCardsCount;
        return $this;
    }

    /**
     * @return array
     */
    public function getCards():array
    {
        return $this->cards;
    }

    /**
     * @param array $cards
     * @return CardsInfo
     */
    public function setCards(array $cards):CardsInfo
    {
        $this->cards = $cards;
        return $this;
    }



}