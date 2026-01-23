<?php

namespace App\Test\Business\Warehouse;

use App\Test\Business\Report;

class WarehouseReport extends Report
{
    public function showInfo(): array
    {
        $sumMass = 0;
        $boxesIds = [];
        foreach ($this->boxes as $box) {
            $boxesIds[] = $box->getId();
            $sumMass += $box->getMass();
        }
        return [
            "boxesIds" => $boxesIds,
            "truckId" => $this->truckId,
            "commonMass" => $sumMass,
            // тут еще что то  для банковских работников итд
        ];
    }
}
