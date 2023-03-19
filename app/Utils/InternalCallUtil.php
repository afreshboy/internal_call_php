<?php

namespace App\Utils;

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
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
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
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }
}
