<?php

namespace App\Http\Controllers;

use App\Utils\InternalCallUtil;
use Illuminate\Http\Request;


class InternalCallController extends Controller
{
    function internal_call(Request $request) : string {
        $service_id = $request -> header("X-SERVICE-ID", "");
        $method = $request -> header("X-SERVICE-METHOD", "");
        $uri = $request -> header("X-SERVICE-URI", "");
        $num1 = $request -> header("X-SERVICE-VALUE1", "");
        $num2 = $request -> header("X-SERVICE-VALUE2", "");
        $resp = "";
        $util = new InternalCallUtil();
        $headers = array("TEST_HEADER"=>"test");
        $param_map = array("num1"=>$num1, "num2"=>$num2);
        if ($method == "GET") {
            $resp = $util -> internal_call_get($uri, $service_id, $param_map, $headers);
        } elseif ($method == "POST") {
            $body = json_encode($param_map);
            $resp = $util -> internal_call_post($uri, $service_id, $body, $headers);
        }
        echo $resp;
        return $resp;
    }
}
