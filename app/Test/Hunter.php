<?php

namespace App\Test;

class Hunter
{
    private Gun $gun;

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
