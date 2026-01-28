<?php

namespace App\Test\RPG3;

abstract class Weapon
{
    public const MAX_WEIGHT = 50;

    private int $damage;

    /**
     * @return int
     */
    public function getDamage(): int
    {
        return $this->damage;
    }

    public function __construct(int $damage)
    {
        $this->damage = $damage;
    }

    public abstract function attack(): void;
}
