<?php
include_once './utils/connect.php';

function order_count($uid)
{
    // 获取总数据量
    $sql = "select count(*) as amount from ding where uid='$uid'";
    $result = mysql_query($sql);
    $row = mysql_fetch_row($result);
    return $row[0];
}

function order_list($uid, $page, $page_size, $name, $phone)
{
    $page_limit = ($page - 1) * $page_size;
    $sql_query = <<<SQL
SELECT * FROM ding 
WHERE shouname LIKE '$name%' AND tel LIKE '$phone%' 
  AND uid='$uid' LIMIT $page_limit,$page_size
SQL;
    $result = mysql_query($sql_query);
    $records = array();
    while ($record = mysql_fetch_assoc($result)) {
        $records[] = $record;
    }
    return $records;
}

function order_add($type, $ordernum, $total, $shouname, $tel, $kuainame, $kuainum, $date01, $date02, $kename, $gid, $num, $uid)
{
    // 将订单数据插入到ding表中
    $sql = <<<SQL
insert into 
    ding(type, ordernum, total, shouname, tel, kuainame, kuainum, date01, date02, date03, kename, gid, num, uid) 
values('$type', '$ordernum', '$total', '$shouname', '$tel', '$kuainame', 
       '$kuainum', '$date01', '$date02','', '$kename', '$gid', '$num', '$uid')
SQL;
    // 执行SQL语句
    return mysql_query($sql);
}

function order_delete($id)
{
    $sql_query = "delete from cart where id='$id'";
    return mysql_query($sql_query);
}

function order_info($id)
{
    $sql1 = "select * from ding where id='$id'";
    $result1 = mysql_query($sql1);
    $records = array();
    while ($rows = mysql_fetch_array($result1)) {
        $records[] = $rows;
    }
    return $records;
}

function cart_update($num, $cid, $username)
{
    // 更新 cart 表中特定 cart item 的数量
    $sql = "UPDATE cart SET num='$num' WHERE id='$cid' AND uid IN (SELECT id FROM user WHERE username ='$username')";
    $result = mysql_query($sql);
    return $result;
}