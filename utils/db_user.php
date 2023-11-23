<?php
include_once './utils/connect.php';

function user_get_id($username)
{
    // 获取当前用户ID
    $sql = "select id from user where username='$username'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) > 0) {
        if ($row = mysql_fetch_array($result)) {
            return $row[0];
        }
    }
    return 0;
}


//登录验证，登录失败返回false，登录成功返回数据
function user_login($username, $password)
{
    $sql = "select * from user where username='$username' and password='$password' and status!='2'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) > 0) {
        if ($row = mysql_fetch_assoc($result)) {
            return $row;
        }
    } else {
        return false;
    }
}