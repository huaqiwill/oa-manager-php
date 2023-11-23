<?php
header("Content-type: text/html; charset=utf8");


// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下

$a = substr($_SERVER["QUERY_STRING"], 3);

include_once("../connect.php");

$sql_insert = "update goods set name='" . $_POST['name'] . "',price='" . $_POST['price'] . "' ,vprice='" . $_POST['vprice'] . "' ,num='" . $_POST['num'] . "' where  id='" . $a . "'";

$res_insert = mysql_query($sql_insert);


if ($res_insert) {
    echo '<script>window.location="goods.php";</script>';
} else {
    echo '<script>window.location="goods.php";</script>';
}


?>