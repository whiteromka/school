<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class TestController extends Controller
{
    // GET /test/test1
    public function test1()
    {
        return new Response([
            'status' => 'ok',
        ]);
    }
}
