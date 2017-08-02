<?php

namespace Entity\Player;


/**
 * Class Player
 * @package Entity\Player
 */
class Player implements IPlayer
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $money;

    /**
     * @var \SplObjectStorage
     */
    public $hand;

    /**
     * Player constructor.
     * @param string $name
     * @param int $money
     */
    public function __construct(string $name, int $money)
    {
        $this->name = $name;
        $this->money = $money;
        $this->hand = new \SplObjectStorage();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMoney(): int
    {
        return $this->money;
    }

    /**
     * @param int $money
     * @throws \Exception
     */
    public function bet(int $money)
    {
        if ($money < 0) {
            throw new \Exception('Invalid bet');
        }

        if ($money > $this->getMoney()) {
            throw new \Exception('Not enough money to bet ' . $money);
        }

        $this->money -= $money;
    }

    public function getHand(): \SplObjectStorage
    {
        return $this->hand;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

}