<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseReqController extends Controller
{
    public function get_count(Request $request): int
    {
        $num1 = $request->input('num1', 0);
        $num2 = $request->input('num2', 0);
        return (int)$num1 + (int)$num2;
    }

    public function post_count(Request $request): int
    {
        $num1 = $request->input('num1', 0);
        $num2 = $request->input('num2', 0);
        return (int)$num1 + (int)$num2;
    }

    public function test()
    {
        return bcmod("5", "2");
    }
}


