<?php

namespace App\Test\Business;

use App\Test\Business\Warehouse\Box;

abstract class Report
{
    protected string $truckId;

    /** @var Box[] */
    protected array $boxes;

    protected string $format;

    public function __construct(string $truckId, array $boxes, string $format)
    {
        $this->truckId = $truckId;
        $this->boxes = $boxes;
        $this->format = $format;
    }

    abstract public function showInfo(): array;
}
