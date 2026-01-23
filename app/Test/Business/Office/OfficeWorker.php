<?php

namespace App\Test\Business\Office;

use App\Test\Business\Report;
use App\Test\Business\ReporterInterface;
use App\Test\Business\Warehouse\Box;
use App\Test\Business\WorkerInterface;

class OfficeWorker implements ReporterInterface, WorkerInterface
{
    private string $truckId;

    /** @var Box[] */
    private array $boxes;

    private function assignTruck()
    {
        $foundTruckId = uniqid(); // какбудто бы узнал номер грузовика в который должны загрузить
        $this->truckId = $foundTruckId;
    }

    private function assignBoxes()
    {
        // как то узнал какие коробки нужны, например из БД
        // $neededBoxes = DB::Boxes->find()->where(['status' => 'wait_to_delivery'])->all();
        $neededBoxes = [
            new Box(1, 15, [1,2,2]),
            new Box(2, 10, [1,1,1])
        ];

        $this->boxes = $neededBoxes;
    }

    public function makeJob(): void
    {
        echo "OfficeWorker делает работу" . "<br>";
        $this->assignTruck();
        $this->assignBoxes();
    }

    public function writeReport(): Report
    {
        echo "OfficeWorker пишет отчет" . "<br>";

        $truckId = $this->truckId;
        $boxes = $this->boxes;

        return new OfficeReport($truckId, $boxes, 'excel');
    }
}
