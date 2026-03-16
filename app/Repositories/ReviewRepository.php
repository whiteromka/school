<?php

namespace App\Repositories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository
{
    public function getAll(): Collection
    {
        return Review::query()->get();
    }

    public function getById(int $id): ?Review
    {
        return Review::query()->find($id);
    }

    public function getByUserId(int $userId): Collection
    {
        return Review::query()
            ->where('user_id', $userId)
            ->get();
    }

    public function create(array $data): Review
    {
        return Review::query()->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $review = Review::query()->find($id);
        if (!$review) {
            return false;
        }

        return $review->update($data);
    }

    public function delete(int $id): bool
    {
        $review = Review::query()->find($id);
        if (!$review) {
            return false;
        }

        return $review->delete();
    }
}
