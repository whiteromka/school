<?php

namespace App\Livewire;

use App\Services\ReviewService;
use Livewire\Component;

class Reviews extends Component
{
    public int $page = 1;
    public int $perPage = 3;
    public bool $hasMore = true;
    public array $loadedReviews = [];

    public function mount()
    {
        $this->loadInitialReviews();
    }

    public function loadMore()
    {
        $this->page++;
        $reviewService = app(ReviewService::class);
        $newReviews = $reviewService->getReviewsPaginated($this->page, $this->perPage);

        foreach ($newReviews as $review) {
            $this->loadedReviews[] = [
                'id' => $review->id,
                'user_id' => $review->user_id,
                'modules_id' => $review->modules_id,
                'stars' => $review->stars,
                'status' => $review->status,
                'message' => $review->message,
                'created_at' => $review->created_at->format('d.m.Y'),
                'user_name' => $review->user->getFullNameOrEmail(),
                'module_name' => $review->module?->name,
            ];
        }

        //$this->updateHasMore();
    }

    private function loadInitialReviews()
    {
        $reviewService = app(ReviewService::class);
        $reviews = $reviewService->getReviewsPaginated($this->page, $this->perPage);

        foreach ($reviews as $review) {
            $this->loadedReviews[] = [
                'id' => $review->id,
                'user_id' => $review->user_id,
                'modules_id' => $review->modules_id,
                'stars' => $review->stars,
                'status' => $review->status,
                'message' => $review->message,
                'created_at' => $review->created_at->format('d.m.Y'),
                'user_name' => $review->user->getFullNameOrEmail(),
                'module_name' => $review->module?->name,
            ];
        }

        //$this->updateHasMore();
    }

    private function updateHasMore()
    {
        $reviewService = app(ReviewService::class);
        $this->hasMore = $reviewService->hasMoreReviews($this->page, $this->perPage);
    }

    public function render()
    {
        return view('partials.reviews', [
            'reviews' => collect($this->loadedReviews),
            'hasMore' => $this->hasMore,
        ]);
    }
}
