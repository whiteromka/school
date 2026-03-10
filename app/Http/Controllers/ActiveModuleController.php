<?php

namespace App\Http\Controllers;

use App\Services\ActiveModuleService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActiveModuleController extends Controller
{
    public function __construct(
        private readonly ActiveModuleService $activeModuleService
    ) {}

    // POST active-module/join/{module_id}
    public function join(Request $request, int $module_id): JsonResponse
    {
        if (!$request->user()) {
            return response()->json(['success' => false, 'message' => 'Требуется авторизация'], 401);
        }

        try {
            $this->activeModuleService->joinUserToModule($request->user(), $module_id);
            
            return response()->json([
                'success' => true,
                'message' => 'Вы успешно записались на модуль',
                'action' => 'joined',
                'module_id' => $module_id,
            ]);
        } catch (Exception $e) {
            Log::error('Error ActiveModuleController::join() ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // POST active-module/leave/{module_id}
    public function leave(Request $request, int $module_id): JsonResponse
    {
        if (!$request->user()) {
            return response()->json(['success' => false, 'message' => 'Требуется авторизация'], 401);
        }

        try {
            $this->activeModuleService->leaveUserFromModule($request->user(), $module_id);
            
            return response()->json([
                'success' => true,
                'message' => 'Вы успешно отписались от модуля',
                'action' => 'left',
                'module_id' => $module_id,
            ]);
        } catch (Exception $e) {
            Log::error('Error ActiveModuleController::leave() ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
