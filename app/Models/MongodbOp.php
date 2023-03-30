<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class MongodbOp {
    protected static string $connection = 'mongodb';

    public static function insert($collection, $data) {
        return DB::connection(static::$connection) -> collection($collection) -> insert($data);
    }

    public static function get($collection, $where): array
    {
        $rows = DB::connection(static::$connection) -> collection($collection) -> where($where);
        $count = $rows -> count();
        $list = $rows -> find();
        return array(['count'=>$count, 'list'=>$list]);
    }

    public static function delete($collection, $where) {
        return DB::connection(static::$connection) -> collection($collection) -> where($where) -> delete();
    }

}
