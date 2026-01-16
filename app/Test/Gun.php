<?php

namespace App\Test;

class Gun
{
    public $damage = 10;
    public function shoot(): void
    {
        echo 'Bom!';
    }
}
