<?php
function header_html()
{
    header("Content-type: text/html; charset=utf8");
}

function request_data()
{
    return json_decode(file_get_contents("php://input"));
}

function session_on()
{
    if (!session_id()) session_start();
}

function check_login()
{
    if (!isset($_SESSION['username'])) {
        header('Location:../login.php');
    }
}

function data_get($arr, $key)
{
    if (array_key_exists($key, $arr) && $arr[$key] != '') {
        return $arr[$key];
    }
    return false;
}

//检查参数是否满足要求，不符合要求，则返回错误信息
function data_check($raw_arr, $rules)
{
    $keys = array_keys($rules);
    foreach ($keys as $key) {
        if ($data = data_get($raw_arr, $key)) {

        } else {
            return $rules[$key];
        }
    }
    //符合要求
    return false;
}

function request_post($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}