<?php

namespace Service\Rank;

use Entity\Rank\IRank;

/**
 * Class RankFactory
 * @package Service\Rank
 */
class RankFactory
{
    /**
     * @param string $rankName
     * @return IRank
     * @throws \Exception
     */
    public static function getRank(string $rankName): IRank
    {
        $className = 'Entity\\Rank\\' . ucfirst(strtolower($rankName));
        if (!class_exists($className)) {
            throw new \Exception("Class {$className} not exists");
        }
        return new $className;
    }
}