<?php

namespace App\Http\Controllers;

use App\Models\RedisOp;
use Illuminate\Http\Request;

class RedisController extends Controller
{
    public function set(Request $request)
    {
        $key = $request->input('key', "test_key");
        $value = $request->input('value', "test_value");
        return RedisOp::set($key, $value);
    }

    public function get(Request $request)
    {
        $key = $request->input('key', "test_key");
        return RedisOp::get($key);
    }
}
