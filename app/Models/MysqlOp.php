<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class MysqlOp
{
    public static function insertPerson($table, $data) {
        return DB::table($table)->insert(
            $data
        );
    }

    public static function getByName($table, $name): array
    {
        return DB::table($table)->where('name', '=', $name)->get()->all();
    }

    public static function delete($table, $name) {
        return DB::table($table) -> where('name', '=', $name) -> delete();
    }
}
