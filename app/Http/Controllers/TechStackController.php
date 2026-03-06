<?php

namespace App\Http\Controllers;

class TechStackController extends Controller
{
    public function info(int $id)
    {
        $data = [
            '1' => ['name' => 'javascript', 'description' => 'This is JavaScript'],
            '2' => 'popopopopopopopo',
            '3' => 'hjhjhjhjhjhjhjhjh'
        ];
        $res = $data[$id];
        return response()->json(['res' => $res]);
    }
}
