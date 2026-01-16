<?php

namespace App\Test;

class Usr
{
    public string $name = 'John';
    public string $lName = 'Snow';

    protected int $age = 18;

    private int $account = 123243243;


    public function sayName(): string
    {
        return $this->name . ' ' . $this->lName;
    }

    public function changeAccount(): int
    {
        return $this->account = 43535435432;
    }
}
