<?php

namespace App\Test\RPG3;

class Orc
{
    private string $name;
    private int $age;
    private Weapon $weapon;

    public function setWeapon(Weapon $weapon): void
    {
//        if (Weapon::MAX_WEIGHT > $weapon->getMass()) {
//            $this->weapon = $weapon;
//        } else {
//            throw new \Exception("Max allowed weight is exceeded, allowed no more than " . Weapon::MAX_WEIGHT);
//        }
        $this->weapon = $weapon;
    }

    public function __construct(string $name, int $age, Weapon $weapon)
    {
        $this->name = $name;
        $this->age = $age;
        $this->weapon = $weapon;
    }

    public function attack(): void
    {
        $this->weapon->attack();
    }
}
