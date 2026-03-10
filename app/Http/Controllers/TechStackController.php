<?php

namespace App\Http\Controllers;

use App\Services\TechStackService;

class TechStackController extends Controller
{
    public function __construct(
        private readonly TechStackService $techStackService
    ) {}

    // GET tech-stack/info/
    public function info(int $id)
    {
        $res = $this->techStackService->getById($id);
        return response()->json(['res' => $res]);
    }
}
