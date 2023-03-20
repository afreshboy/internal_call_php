<?php

namespace App\Http\Controllers;

use App\Utils\InternalCallUtil;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InternalCallController extends Controller
{
    function internal_call(Request $request) : Response
    {
        $service_id = $request->header("X-SERVICE-ID", "");
        $method = $request->header("X-SERVICE-METHOD", "");
        $uri = $request->header("X-SERVICE-URI", "");
        $num1 = $request->header("X-SERVICE-VALUE1", "");
        $num2 = $request->header("X-SERVICE-VALUE2", "");
        $util = new InternalCallUtil();
        $headers = array("TEST_HEADER" => "test");
        $param_map = array("num1" => $num1, "num2" => $num2);
        if ($method == "GET") {
            try {
                $response = $util->internal_call_get($uri, $service_id, $param_map, $headers);
                return Response($response);
            } catch (Exception $e) {
                echo "get error";
                return Response($e->__toString(), 500);
            }
        } elseif ($method == "POST") {
            try {
                $response = $util->internal_call_post($uri, $service_id, $param_map, $headers);
                return Response($response);
            } catch (Exception $e) {
                echo "get error";
                return Response($e->__toString(), 500);
            }
        } else {
            return Response(sprintf("invalid method: %s", $method), 403);
        }
    }
}
