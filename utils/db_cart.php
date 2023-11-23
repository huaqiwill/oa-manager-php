<?php
include_once './utils/connect.php';
function cart_clear($uid)
{
    // 清空购物车
    $sql = "delete from cart where uid='$uid'";
    return mysql_query($sql);
}

function cart_exists($gid, $uid)
{
    $sql = <<<SQL
SELECT cart.*, goods.price, goods.vprice 
FROM cart 
    JOIN goods ON cart.gid=goods.id 
WHERE gid='$gid' 
  AND uid='$uid'
SQL;
    // 执行SQL语句
    return mysql_query($sql);
}

function cart_update($gid, $uid)
{
    $sql01 = <<<SQL
UPDATE cart 
SET num=num+1  
WHERE gid='$gid' 
  AND uid='$uid')
SQL;
    // 执行SQL语句
    return mysql_query($sql01);
}

function cart_insert($gid, $uid)
{
    $sql_insert = "INSERT INTO cart(gid,num,uid) VALUES ('$gid','1','$uid')";
    return mysql_query($sql_insert);    // 执行SQL语句
}

