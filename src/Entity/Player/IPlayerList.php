<?php


namespace Entity\Player;


interface IPlayerList
{
    public function attach($player, $priority);

    public function detach($player);
}