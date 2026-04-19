<?php

namespace App\Services\HH;

interface HHInterface
{
    public function fetchVacancies(string $type = 'PHP'): void;
}
