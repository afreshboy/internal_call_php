<?php


namespace App\Http\Controllers;

use App\Models\MongodbOp;
use Illuminate\Http\Request;

class MongoController extends Controller
{
    public function get(Request $request): array
    {
        $collection = $request->input('collection', 'demo');
        $where = $request->input('condition', []);
        $mongo = new MongodbOp();
        return $mongo -> get($collection, $where);
    }

    public function insert(Request $request)
    {
        $collection = $request->input('collection', 'demo');
        $data = $request->input('data', []);
        $mongo = new MongodbOp();
        return $mongo -> insert($collection, $data);
    }

    public function delete(Request $request)
    {
        $collection = $request->input('collection', 'demo');
        $where = $request->input('condition', []);
        $mongo = new MongodbOp();
        return $mongo -> delete($collection, $where);
    }
}


