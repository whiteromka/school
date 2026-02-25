<?php

namespace App\Test;

use App\Models\User;

class Hunter
{
    private Gun $gun;
    public User $user;
    public string $name;
    private int $age;

    public const MAX_HEALTH = 1000;
    public const STATUS_SLEEP = "sleep";
    public const STATUS_EAT = "eat";
    public const STATUS_COOK = "cook";

    public static function getStatuses(): array
    {
        return [
            self::STATUS_SLEEP,
            self::STATUS_EAT,
            self::STATUS_COOK
        ];
    }

    public static function maxHealth(): int
    {
        return self::MAX_HEALTH;
    }

    public function __construct(Gun $gun)
    {
        $this->gun = $gun;
    }

    public function getGun(): Gun
    {
        return $this->gun;
    }

    public function setGun(Gun $g): void
    {
        $this->gun = $g;
    }

    public function shoot(): void
    {
        $this->gun->shoot();
    }
}
