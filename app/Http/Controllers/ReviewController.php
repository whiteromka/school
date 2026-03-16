<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use App\Services\ActiveModuleService;
use App\Services\CaptchaService;
use App\Services\ReviewService;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    public function __construct(
        private readonly ReviewService $reviewService,
        private readonly ActiveModuleService $activeModuleService
    ) {}

    /**
     * Store a newly created review in storage.
     */
    public function store(StoreReviewRequest $request): Response
    {
        $this->reviewService->create([
            'user_id' => auth()->id(),
            ...$request->reviewData(),
            'status' => Review::STATUS_NEW,
        ]);

        return response()->view('partials.review-form', [
            'activeModules' => $this->activeModuleService->getUserActiveModules(auth()->user()),
            'errors' => [],
            'oldInput' => [],
            'success' => true,
        ]);
    }

    /**
     * Обновление капчи (AJAX)
     */
    public function refreshCaptcha(): Response
    {
        $captcha = CaptchaService::generate();
        return response()->view('partials.captcha', [
            'captcha' => $captcha,
            'error' => null,
        ]);
    }
}
