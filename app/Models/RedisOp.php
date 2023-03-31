<?php

namespace App\Models;


use Illuminate\Support\Facades\Redis;

class RedisOp
{
    public static function set($key, $value) {
        return Redis::set($key, $value);
    }

    public static function get($key) {
        return Redis::get($key);
    }

}
