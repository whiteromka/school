<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Models\Review;
use App\Services\ActiveModuleService;
use App\Services\CaptchaService;
use App\Services\ReviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\ViewErrorBag;

class ReviewController extends Controller
{
    public function __construct(
        private readonly ActiveModuleService $activeModuleService,
        private readonly ReviewService $reviewService
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

    /**
     * GET /review/delete-review
    */
    public function deleteReview(int $id): JsonResponse
    {
        $user = auth()->user();
        $review = $this->reviewService->getById($id);
        $isDeleted = false;
        if ($review->user_id === $user->id) {
            $isDeleted = $this->reviewService->delete($id);
        }
        return response()->json(['success' => $isDeleted]);
    }

    /**
     * GET /review/list
     */
    public function index(): JsonResponse
    {
        $reviews = auth()->user()->reviews;
        return response()->json(['reviews' => $reviews]);
    }

    /**
     * GET /review/get-by-id
     */
    public function getById(int $id): JsonResponse
    {
        $review = $this->reviewService->getById($id);
        return response()->json([
            'review' => $review,
            'success' => (bool)$review
        ]);
    }

    /**
     * POST /review/update
     */
    public function update(ReviewUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $review = $this->reviewService->getById($data['id']);
        if ($review->status !== Review::STATUS_NEW) {
            return response()->json([
                'success' => false,
                'error' => 'Нельзя редактировать отзыв с данным статусом'
            ], 403);
        }

        $success = $review->update($data);
        $review->refresh();
        return response()->json([
            'success' => $success,
            'review' => $review
        ]);
    }
}
