<?php

namespace App\Test\Business\Warehouse;

use App\Test\Business\ReporterInterface;
use App\Test\Business\Report;
use App\Test\Business\WorkerInterface;

class WarehouseWorker implements ReporterInterface, WorkerInterface
{
    private function loadBoxes(): void
    {
        echo "WarehouseWorker грузит коробки в грузовик" . "<br>";
        // $isCan = $this->canNextBoxInTruck();
        // if ($isCan) {
        // грузим еще коробку
        //}
    }

//    public function canNextBoxInTruck(Box $box, $truck): bool
//    {
//        // Проверяем что можно запихать еще коробку в грузовик
//    }

    public function makeJob(): void
    {
        $this->loadBoxes();
        echo "WarehouseWorker делает свою работу" . "<br>";
    }

    public function writeReport(): Report
    {
        echo "OfficeWorker пишет отчет" . "<br>";

        $truckId = 123;
        $boxes = [
            new Box(1, 15, [1,2,2])
        ];

        return new WarehouseReport($truckId, $boxes, 'word');
    }

}
