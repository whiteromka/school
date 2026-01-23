<?php

namespace App\Test\Business;

interface ReporterInterface
{
    public function writeReport(): Report;
}
