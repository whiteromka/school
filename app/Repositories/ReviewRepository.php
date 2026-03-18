<?php

namespace App\Repositories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ReviewRepository
{
    public function getAll(): Collection
    {
        return Review::query()->get();
    }

    public function getReviews(): Collection
    {
        return Review::query()
            ->with(['user', 'module'])
            ->get();
    }

    public function getReviewsPaginated(int $page, int $perPage): Collection
    {
//        $offset = ($page - 1) * $perPage;
//        $sql = 'SELECT
//            reviews.*,
//            users.email,
//            users.first_name,
//            users.last_name,
//            modules.name as module_name
//        FROM reviews
//            INNER JOIN users ON reviews.user_id = users.id
//            LEFT JOIN modules ON reviews.modules_id = modules.id
//        ORDER BY reviews.created_at DESC
//        LIMIT ? OFFSET ?';
//        $results = DB::select($sql, [$perPage, $offset]);

        return Review::query()
            ->with(['user', 'module'])
            ->orderBy('created_at', 'desc')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();
    }

    public function hasMoreReviews(int $page, int $perPage): bool
    {
        $total = Review::query()->count();
        return $total > ($page * $perPage);
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
