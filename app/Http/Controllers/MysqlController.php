<?php

namespace App\Http\Controllers;

use App\Models\MysqlOp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MysqlController extends Controller
{
    function get(Request $request) : array {
        return MysqlOp::getByName($request->input('table', 'person'), $request->input('table', 'Jack'));
    }
    function insert(Request $request)
    {
        return MysqlOp::insertPerson($request->input('table', 'person'), $request->input('table', 'data'));
    }

    function delete(Request $request)
    {
        return MysqlOp::delete($request->input('table', 'person'), $request->input('table', 'Jack'));
    }
}