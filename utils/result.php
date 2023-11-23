<?php

function header_json()
{
    header('Content-Type:application/json; charset=utf-8');
}

function result($code, $message, $data)
{
    $arr = array(
        "code" => $code,
        "message" => $message
    );
    if ($data != null) {
        $arr["data"] = $data;
    }
    return json_encode($arr, JSON_UNESCAPED_UNICODE);
}

function ret_err($message)
{
    exit(result(201, $message, null));
}

function ret_ok($message, $data = null)
{
    exit(result(200, $message, $data));
}

header_json();
//这个函数的作用就是清除下json数据前面的bom头
ob_clean();