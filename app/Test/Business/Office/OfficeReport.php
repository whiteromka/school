<?php

namespace App\Test\Business\Office;

use App\Test\Business\Report;

class OfficeReport extends Report
{
    public function showInfo(): array
    {
        $boxesIds = [];
        foreach ($this->boxes as $box) {
            $boxesIds[] = $box->getId();
        }
        return [
            "boxesIds" => $boxesIds,
            "truckId" => $this->truckId
        ];
    }
}
