<?php
include_once './utils/connect.php';

function goods_info($id)
{
    $sql_goods = "SELECT * FROM goods WHERE id='$id'";
    $result_goods = mysql_query($sql_goods);    // 执行SQL语句
    if ($result_goods) {
        return mysql_fetch_array($result_goods);
    }
    return false;
}


function goods_list()
{
    $sql2 = "select * from goods";
    $result2 = mysql_query($sql2);
    $res = [];
    while ($row = mysql_fetch_assoc($result2)) {
        $res[] = $row;
    }
    return $res;
}