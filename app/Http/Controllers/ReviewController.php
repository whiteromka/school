<?php

namespace App\Http\Controllers;

use App\Enums\ReviewStatus;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Models\Review;
use App\Models\User;
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


    /** Модули на которые записан пользователь
     * GET /review/user-modules
     */
    public function userModules(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user) {
            $user->load(['activeModules.module:id,name']);
            $modules = $user->activeModules
                ->filter(fn($item) => $item->module !== null)
                ->mapWithKeys(function ($item) {
                    return [
                        $item->module->id => $item->module->name
                    ];
                });
        } else {
            $modules = [];
        }

        return response()->json([
            'success' => true,
            'data' => $modules
        ]);
    }

    /** Для главной страницы форма отправки отзывов
     * POST /review/store
     */
    public function store(ReviewStoreRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $data = $request->validated();
        $review = Review::query()->create([
            'user_id' => $user->id,
            'modules_id' => $data['modules_id'] ?? null,
            'stars' => $data['stars'],
            'message' => $data['message'],
            'status' => 'new',
        ]);

        return response()->json([
            'success' => true,
            'data' => $review
        ]);
    }

    /**
     * Обновление капчи (AJAX)
     */
//    public function refreshCaptcha(): Response
//    {
//        $captcha = CaptchaService::generate();
//        $errors = session('errors') ?? new ViewErrorBag();
//
//        return response()->view('partials.captcha', [
//            'captcha' => $captcha,
//            'errors' => $errors,
//        ]);
//    }

    /**
     * POST /review/delete-review
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
        /** @var User $user */
        $user = auth()->user();
//        $user->load([
//            'profile',
//            'oauthAccounts',
//            'reviews.module:id,name'
//        ]);

        $reviews = $user
            ->reviews()
            ->with('module:id,name')
            ->get();

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
        if ($review->status !== ReviewStatus::NEW->value) {
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
