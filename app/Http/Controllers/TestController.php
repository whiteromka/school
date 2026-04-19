<?php

namespace App\Http\Controllers;

use App\Services\HH\HHParserService;
use Illuminate\Http\Response;

class TestController extends Controller
{
    // GET /test/test1
    public function test1()
    {
        $a = 1;
        return new Response([
            'status' => 'school',
        ]);
    }

    // GET /test/hh
//    public function hh(HhService $hh)
//    {
//        return $hh->search();
//    }

    // GET /test/hh-simple
    public function hhSimple(HHParserService $hh)
    {
        return $hh->searchSimple();
    }


}
