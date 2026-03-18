<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewStoreRequest;
use App\Models\Review;
use App\Services\ActiveModuleService;
use App\Services\CaptchaService;
use Illuminate\Http\Response;
use Illuminate\Support\ViewErrorBag;

class ReviewController extends Controller
{
    public function __construct(
        private readonly ActiveModuleService $activeModuleService
    ) {}

    /**
     * Store a newly created review in storage.
     */
    public function store(ReviewStoreRequest $request): Response
    {
        $this->reviewService->create([
            'user_id' => auth()->id(),
            ...$request->reviewData(),
            'status' => Review::STATUS_NEW,
        ]);

        return response()->view('partials.review-form', [
            'activeModules' => $this->activeModuleService->getUserActiveModules(auth()->user()),
            'errors' => new ViewErrorBag(),
            'success' => true,
        ]);
    }

    /**
     * Обновление капчи (AJAX)
     */
    public function refreshCaptcha(): Response
    {
        $captcha = CaptchaService::generate();
        $errors = session('errors') ?? new ViewErrorBag();

        return response()->view('partials.captcha', [
            'captcha' => $captcha,
            'errors' => $errors,
        ]);
    }
}
