<?php

namespace Entity\State;


use Entity\Game\IGame;

class DrawState implements IState
{
    /** @var  IGame */
    protected $game;

    public function __construct(IGame $game)
    {
        $this->game = $game;
    }

    public function play()
    {
        $this->getGame()->changeState(new PostDrawState($this->getGame()));
    }

    /**
     * @return IGame
     */
    public function getGame(): IGame
    {
        return $this->game;
    }
}