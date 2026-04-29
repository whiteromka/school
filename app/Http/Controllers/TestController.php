<?php

namespace App\Http\Controllers;

use App\Services\SlackLog;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    // GET /test/test1
    public function test1(TelegramService $telegramService): void
    {
//        $url = config('services.slack.school_errors_chat');
//        $response = Http::post($url, [
//            'text' => 'New message!!!', // работает
//        ]);
//        dd($response->status()); // "ok"
        SlackLog::log("error message");
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
