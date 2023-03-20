<?php

namespace App\Utils;

use Exception;

class InternalCallUtil {
    function internal_call_get(string $uri, string $to_service_id, array $param_map, array $headers): string {
        $from_service_id = getenv("SERVICE_ID");
        $url = sprintf("http://%s-%s.dycloud.service%s", $from_service_id, $to_service_id, $uri);
        $ch = curl_init();
        $timeout = 5;
        $i = 0;
        foreach($param_map as $x=>$x_value) {
            if ($i == 0) {
               $url .= "?";
            }
            $url = sprintf("%s%s=%s", $url, $x, $x_value);
            if ($i < count($param_map) - 1) {
                $url .= "&";
            }
            $i++;
        }
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        try {
            $file_contents = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            echo $http_code;
            if (!($http_code >= 200 && $http_code < 300)) {
                curl_close($ch);
                throw new Exception(sprintf("err statuscode: %s", $http_code));
            }
            curl_close($ch);
            return $file_contents;
        } catch (Exception $e) {
            curl_close($ch);
            throw $e;
        }
    }

    function internal_call_post(string $uri, string $to_service_id, array $body, array $headers): string {
        $from_service_id = getenv("SERVICE_ID");
        $url = sprintf("http://%s-%s.dycloud.service%s", $from_service_id, $to_service_id, $uri);
        $ch = curl_init();
        $timeout = 5;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        try {
            $file_contents = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            echo $http_code;
            if (!($http_code >= 200 && $http_code < 300)) {
                curl_close($ch);
                throw new Exception(sprintf("err statuscode: %s", $http_code));
            }
            curl_close($ch);
            return $file_contents;
        } catch (Exception $e) {
            curl_close($ch);
            throw $e;
        }
    }
}
