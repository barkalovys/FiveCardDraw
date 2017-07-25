<?php

namespace Entity\Game\FiveCardDraw;

use Entity\Game\IGame;
use Entity\Player\IPlayer;
use Entity\Player\IPlayerList;
use Service\Deck\IDeckBuilder;

class FiveCardDraw implements IGame
{
    /**
     * @var \Entity\Deck\IDeck
     */
    public $deck;

    /**
     * @var IPlayerList
     */
    protected $players;

    protected $turn = 0;

    protected $bank = 0;

    /**
     * @var IPlayer
     */
    protected $winner;

    public function __construct(IDeckBuilder $builder, IPlayerList $playerList)
    {
        $this->deck = $builder->build();
        $this->players = $playerList;
        for ($i = 0; $i < 5; ++$i) {
            foreach ($this->players as $player) {
                $player->hand->attach($this->deck->draw());
            }
        }
        $this->turn = 0;
    }

    public function loop()
    {
        while (!$this->winner) {
            $this->players->rewind();
            while ($this->players->valid()) {
                /** @var IPlayer $player */
                $player = $this->players->current();
                $this->players->next();
                $bet = $player->getMoney() > 15 ? rand(1, $player->getMoney()) : $player->getMoney();
                $player->bet($bet);
                $this->bank += $bet;
                if (!$player->getMoney()) {
                    $this->players->detach($player);
                }
                if (count($this->players) <= 1) {
                    $this->winner = $this->players->current();
                    break;
                }
            }
        }
        $handString = '';
        foreach ($this->winner->getHand() as $card) {
            $handString .= $card . ', ';
        }
        echo "Player {$this->winner} wins {$this->bank}$ with hand {$handString}!" . PHP_EOL;
    }
}