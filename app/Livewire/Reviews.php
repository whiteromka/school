<?php

namespace App\Livewire;

use App\Services\ReviewService;
use Livewire\Component;

class Reviews extends Component
{
    public function render()
    {
        $reviewService = app(ReviewService::class);
        $reviews = $reviewService->getReviews();

        return view('partials.reviews', [
            'reviews' => $reviews,
        ]);
    }
}
