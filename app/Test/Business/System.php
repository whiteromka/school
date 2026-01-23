<?php

namespace App\Test\Business;

class System
{
    public function __construct(
        private readonly ReporterInterface $officeWorker,
        private readonly ReporterInterface $warehouseWorker
    ){}

    public function run()
    {
        $this->officeWorker->makeJob();
        $this->warehouseWorker->makeJob();

        $r1 = $this->officeWorker->writeReport();
        $r2 = $this->warehouseWorker->writeReport();

        $this->checkReports($r1, $r2);
    }

    private function checkReports(Report $r1, Report $r2)
    {
        $data1 = $r1->showInfo();
        $data1 = $r2->showInfo();
        // сравнивает 1 с 2 находим отличия выводим ошибки
        // если все хорошо, начисляем бонусы обоим сотрудникам
        // ...
    }
}
