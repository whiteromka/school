<?php

namespace App\Services;

use App\Models\Review;
use App\Repositories\ReviewRepository;
use Illuminate\Database\Eloquent\Collection;

class ReviewService
{
    public function __construct(
        private readonly ReviewRepository $reviewRepository
    ) {}

    public function getAll(): Collection
    {
        return $this->reviewRepository->getAll();
    }

    public function getReviews(): Collection
    {
        return $this->reviewRepository->getReviews();
    }

    public function getById(int $id): ?Review
    {
        return $this->reviewRepository->getById($id);
    }

    public function getByUserId(int $userId): Collection
    {
        return $this->reviewRepository->getByUserId($userId);
    }

    public function create(array $data): Review
    {
        return $this->reviewRepository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->reviewRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->reviewRepository->delete($id);
    }
}
