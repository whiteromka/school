<?php

namespace App\Test\Business;

class OfficeWorker
{

    private function cramNumbers(): void
    {
        echo "calculating" . "<br>";
    }

    public function writeReport(): void
    {
        $this->cramNumbers();
        echo "a report on truck loading" . "<br>";
    }
}
