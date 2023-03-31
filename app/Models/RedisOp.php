<?php

namespace App\Models;


use Illuminate\Support\Facades\Redis;

class RedisOp
{
    public static function set($key, $value) {
        $redis = Redis::connection();
        return $redis -> set($key, $value, 60);
    }

    public static function get($key) {
        $redis = Redis::connection();
        return $redis ->get($key);
    }

}
