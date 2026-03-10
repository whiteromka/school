<?php

namespace App\Services;

use App\Models\TechStack;
use App\Repositories\TechStackRepository;

class TechStackService
{
    public function __construct(
        private readonly TechStackRepository $techStackRepository
    ) {}

    public function seedTechStack(array $techStackData): void
    {
        $this->techStackRepository->truncate();

        foreach ($techStackData as $data) {
            $this->techStackRepository->create($data);
        }
    }

    public function getById(int $id): TechStack
    {
        return $this->techStackRepository->getById($id);
    }
}
