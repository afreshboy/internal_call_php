<?php

namespace App\Models;


use Illuminate\Support\Facades\Cache;

class RedisOp
{
    public static function set($key, $value) {
        return Cache::store('redis')->set($key, $value, 60);
    }

    public static function get($key) {
        return Cache::store('redis')->get($key);
    }

}
