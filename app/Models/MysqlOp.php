<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use mysqli;


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

    public static function insert2() {
        $db_host = explode(':', getenv('MYSQL_ADDRESS'))[0];
        $db_port = explode(':', getenv('MYSQL_ADDRESS'))[1];
        $db_name = env('DB_DATABASE', 'laravel');
        $db_user = getenv('MYSQL_USERNAME', 'root');
        $db_pwd = getenv('MYSQL_PASSWORD', '');
        $mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_name, $db_port);
        if(mysqli_connect_error()) {

            echo mysqli_connect_error();

        }

        $mysqli->set_charset("utf8");//或者 $mysqli->query("set names 'utf8'")
        $sql = "insert into person (`name`, `age`) values ('mike', 30)";
        $result = $mysqli->query($sql);
        $mysqli->close();
        return $result;
    }
    public static function get2() {
        $db_host = explode(':', getenv('MYSQL_ADDRESS'))[0];
        $db_port = explode(':', getenv('MYSQL_ADDRESS'))[1];
        $db_name = env('DB_DATABASE', 'laravel');
        $db_user = getenv('MYSQL_USERNAME', 'root');
        $db_pwd = getenv('MYSQL_PASSWORD', '');
        $mysqli = new mysqli($db_host, $db_user, $db_pwd, $db_name, $db_port);
        if(mysqli_connect_error()) {

            echo mysqli_connect_error();

        }
        $sql = "select * from person where name = mike";
        $result = $mysqli->query($sql);
        $mysqli->close();
        return $result;
    }
}

