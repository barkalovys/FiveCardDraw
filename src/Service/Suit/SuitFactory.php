<?php

namespace Service\Suit;

use Entity\Suit\ISuit;

/**
 * Class SuitFactory
 * @package Service\Suit
 */
class SuitFactory
{
    /**
     * @param $suitName
     * @return ISuit
     * @throws \Exception
     */
    public static function getSuit($suitName): ISuit
    {
        $className = 'Entity\\Suit\\' . ucfirst(strtolower($suitName));
        if (!class_exists($className)) {
            throw new \Exception("Class {$className} not exists");
        }
        return new $className;
    }
}