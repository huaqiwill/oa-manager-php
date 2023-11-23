<?php

include './utils/connect.php';

function customer_count($username)
{
    // 获取总数据量
    $sql = "select count(*) as amount from customers where uid in (select id from user where username='$username')";
    $result = mysql_query($sql);
    $row = mysql_fetch_row($result);
    return $row[0];
}

function customer_list($username, $tel, $wechat, $page, $page_size)
{
    $page_limit = ($page - 1) * $page_size;
    $sql = <<<SQL
SELECT * FROM customers 
WHERE tel LIKE '$tel%' 
  AND weixin LIKE '$wechat%' 
  AND uid = (SELECT id FROM user WHERE username='$username') LIMIT $page_limit,$page_size
SQL;
    $result = mysql_query($sql);
    $records = array();
    while ($record = mysql_fetch_assoc($result)) {
        $records[] = $record;
    }
    return $records;
}

function customer_delete($id)
{
    $sql_query = "delete from customers where id='$id'";
    $result = mysql_query($sql_query);
    return $result;
}

function customer_exists($cname, $tel)
{
    $sql = "SELECT * FROM customers,user WHERE customers.uid=user.id AND customers.cname='$cname' OR customers.tel='$tel'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) > 0) {
        if ($row = mysql_fetch_assoc($result)) {
            return $row;
        }
    }
    return false;
}

function customer_add($customer, $username)
{
    $cname = $customer['cname'];
    $ctype = $customer['ctype'];
    $sex = $customer['sex'];
    $laiyuan = $customer['laiyuan'];
    $tel = $customer['tel'];
    $weixin = $customer['weixin'];
    $date01 = $customer['date01'];
    $sheng = $customer['sheng'];
    $cheng = $customer['cheng'];
    $qu = $customer['qu'];
    $email = $customer['email'];
    $address = $customer['address'];
    $sql_insert = <<<SQL
INSERT INTO customers(cname,ctype,sex,laiyuan,tel,weixin,date01,sheng,cheng,qu,email,address,uid) 
VALUES('$cname','$ctype','$sex','$laiyuan','$tel','$weixin','$date01','$sheng','$cheng','$qu','$email',
       '$address',(SELECT id FROM user WHERE username ='$username'))
SQL;
    //执行SQL语句
    return mysql_query($sql_insert);
}

function customer_info($id)
{
    $sql1 = "select * from customers where id='$id'";
    $result1 = mysql_query($sql1);
    $records = array();
    while ($rows = mysql_fetch_assoc($result1)) {
        $records[] = $rows;
    }
    return $records;
}

function customer_edit($customer, $a)
{
    $cname = $customer['cname'];
    $ctype = $customer['ctype'];
    $sex = $customer['sex'];
    $laiyuan = $customer['laiyuan'];
    $tel = $customer['tel'];
    $weixin = $customer['weixin'];
    $date01 = $customer['date01'];
    $sheng = $customer['sheng'];
    $cheng = $customer['cheng'];
    $qu = $customer['qu'];
    $email = $customer['email'];
    $address = $customer['address'];
    $sql_insert = <<<SQL
update customers 
    set cname='$cname',
        ctype='$ctype"',
        sex='$sex',
        laiyuan='$laiyuan',
        tel='$tel',
        weixin='$weixin',
        date01='$date01',
        sheng='$sheng',
        cheng='$cheng',
        qu='$qu',
        email='$email',
        address='$address' 
where id='$a'
SQL;
    return mysql_query($sql_insert);
}

function customer_list_find($uid)
{
    $sql1 = "select * from customers where uid='$uid'";
    $result1 = mysql_query($sql1);
    $result = [];
    while ($rows1 = mysql_fetch_array($result1)) {
        $result[] = $rows1;
    }
    return $result;
}