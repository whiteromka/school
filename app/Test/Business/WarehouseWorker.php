<?php

namespace App\Test\Business;

class WarehouseWorker
{
    public function loadBoxes(): void
    {
        echo "the worker is loading a truck" . "<br>";
    }

    public function writeReport(): void
    {
        echo "the truck is loaded" . "<br>";
    }
}
